<?php
	require_once('../panelwidgets/abstract.widget.php');

	class RamGraphItem
	{
		public $ram_percent;
	}

	class RamGraphWidget extends AbstractWidget
	{
		public $ram_usages;	
		
		public function load()
		{
			$this->ram_usages = array();
			$meminfo = file("/proc/meminfo");
			for ($i = 0; $i < count($meminfo); $i++)
			{
				list($item, $data) = preg_split("/:/", $meminfo[$i], 2);
				$item = trim(chop($item));
				$data = intval(preg_replace("/[^0-9]/", "", trim(chop($data))));
				$item = new RamGraphItem();
				switch($item)
				{
					case "MemTotal":
						$item->ram_percent = $data;
						break;
					case "MemFree":
						$item->ram_percent = $data;
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
						$item = null;
						break;
				}
				
				if ($item != null) {
					$this->ram_usages[] = $item;
				}
			}
		}

		public function manage_post($post)
		{
			return 0;
		}
	}
?>
