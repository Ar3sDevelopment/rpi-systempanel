<?php
	require_once('../abstract.widget.php');

	class MemoryWidget extends AbstractWidget
	{
		public $total_mem;
		public $used_mem;
		public $free_mem;
		public $buffer_mem;
		public $cache_mem;
		public $total_swap;
		public $used_swap;
		public $free_swap;
		
		public $percent_used;
		public $percent_free;
		public $percent_buff;
		public $percent_cach;
		public $percent_swap;
		public $percent_swap_free;
		
		public function load()
		{
			$meminfo = file("/proc/meminfo");
			for ($i = 0; $i < count($meminfo); $i++)
			{
				list($item, $data) = preg_split("/:/", $meminfo[$i], 2);
				$item = trim(chop($item));
				$data = intval(preg_replace("/[^0-9]/", "", trim(chop($data))));
				switch($item)
				{
					case "MemTotal":
						$this->total_mem = $data;
						break;
					case "MemFree":
						$this->free_mem = $data;
						break;
					case "SwapTotal":
						$this->total_swap = $data;
						break;
					case "SwapFree":
						$this->free_swap =
						$data; break;
					case "Buffers":
						$this->buffer_mem = $data;
						break;
					case "Cached":
						$this->cache_mem = $data;
						break;
					default:
						break;
				}
			}
			
			$this->used_mem = $this->total_mem - $this->free_mem;
			$this->used_swap = $this->total_swap - $this->free_swap;
			$this->percent_free = round(($this->free_mem / $this->total_mem) * 100);
			$this->percent_used = round(($this->used_mem / $this->total_mem) * 100);
			$this->percent_swap = round((($this->total_swap - $this->free_swap ) / $this->total_swap) * 100);
			$this->percent_swap_free = round(($this->free_swap / $this->total_swap) * 100);
			$this->percent_buff = round(($this->buffer_mem / $this->total_mem) * 100);
			$this->percent_cach = round(($this->cache_mem / $this->total_mem) * 100);
			$this->used_mem = number_format($this->used_mem);
			$this->used_swap = number_format($this->used_swap);
			$this->total_mem = number_format($this->total_mem);
			$this->free_mem = number_format($this->free_mem);
			$this->total_swap = number_format($this->total_swap);
			$this->free_swap = number_format($this->free_swap);
			$this->buffer_mem = number_format($this->buffer_mem);
			$this->cache_mem = number_format($this->cache_mem);
		}
	}

	$widget = new MemoryWidget();
?>