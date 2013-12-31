<?php
	require_once('../panelwidgets/abstract.widget.php');

	class RamGraphItem
	{
		public $ram_percent;
		public $ram_description;
	}

	class RamGraphWidget extends AbstractWidget
	{
		public $ram_usages;	
		
		public function load()
		{
			$total_mem = 0;
			$free_mem = 0;
			$meminfo = file("/proc/meminfo");
			for ($i = 0; $i < count($meminfo); $i++)
			{
				list($item, $data) = preg_split("/:/", $meminfo[$i], 2);
				$item = trim(chop($item));
				$data = intval(preg_replace("/[^0-9]/", "", trim(chop($data))));
				switch($item)
				{
					case "MemTotal":
						$total_mem = $data;
						break;
					case "MemFree":
						$free_mem = $data;
						break;
					/*case "SwapTotal":
						$this->total_swap = $data;
						break;
					case "SwapFree":
						$this->free_swap = $data;
						break;
					case "Buffers":
						$this->buffer_mem = $data;
						break;
					case "Cached":
						$this->cache_mem = $data;
						break;*/
					default:
						break;
				}
			}
			
			$used_mem = $total_mem - $free_mem;
			$percent_free = round(($free_mem / $total_mem) * 100);
			$percent_used = round(($used_mem / $total_mem) * 100);
			$item_free = new RamGraphItem();
			$item_free->ram_percent = $percent_free;
			$item_free->ram_description = 'Free';
			$item_used = new RamGraphItem();
			$item_used->ram_percent = $percent_used;
			$item_used->ram_description = 'Used';
			$this->ram_usages = array($item_used, $item_free);
		}

		public function manage_post($post)
		{
			return 0;
		}
	}
?>