<?php
return stacks_model::get_instance();

class stacks_model {

	private static $instance;
	protected $theParent;
	protected $utils;
	public $mePath;
	public $stacksPath;
	public $stacksUrl;
	public $themeUrl;
	public $vendorsPath;
	public $vendorsUrl;

	public $enabledStacks;
	public $stackedPages;
	public $dirs;
	public $queryRules;

	public $panelSet;
	public $templates;

    public static function get_instance() {
        if ( ! self::$instance ) {
            self::$instance = new self();
            self::$instance->init();
        }
        return self::$instance;
    }

	public function __construct() {}

	public function init() {
		global $wp_customize;

		$this->mePath = dirname(dirname(dirname(dirname(__FILE__))));
		$this->vendorsPath = dirname(dirname(__FILE__)) . '/vendor/';
		$this->vendorsUrl = get_template_directory_uri() . '/library/honeyguide/stacks/js/vendor/';
		$this->stacksPath = dirname(dirname(dirname(dirname(__FILE__)))) . '/library/honeyguide/stacks/';
		$this->stacksUrl = get_template_directory_uri() . '/library/honeyguide/stacks/';
		$this->themeUrl = get_template_directory_uri();
		$this->instancesPath = dirname(dirname(dirname(dirname(__FILE__)))) . '/library/honeyguide/stacks/instances/';

		if ( ! class_exists( 'Spyc' ) ) require_once ($this->vendorsPath . '/spyc/Spyc.php');

		$this->enabledStacks = Spyc::YAMLLoad(dirname(__FILE__) . '/enabled.yaml')['stacks'];
		$this->stackedPages = Spyc::YAMLLoad(dirname(__FILE__) . '/index.yaml');
		$this->queryRules = Spyc::YAMLLoad(dirname(__FILE__) . '/queryRules.yaml');

// write yaml as json onto disk (to check)
//file_put_contents(dirname(__FILE__) . '/queryRules.json', json_encode($this->queryRules, TRUE));

		$this->panelSet = array();

		$this->loadTemplatesIntoArray();
		$this->dirs = $this->distributeTemplates();
	}

	public function saveRef($id) {
		$this->theParent = $id;
	}

	public function saveUtil($util) {
		$this->utils = $util;
	}

    public function dump($obj, $name) {
		$handle = fopen(dirname(__FILE__) . '/' . $name, 'w');
		fwrite($handle, $this->utils->dump($obj));
		fclose($handle);
    }

    public function dumpYAML($obj, $name) {
		$handle = fopen(dirname(__FILE__) . '/' . $name, 'w');
		fwrite($handle, Spyc::YAMLDump($obj));
		fclose($handle);
    }

    public function loadYAML($name) {
		return Spyc::YAMLLoad(dirname(__FILE__) . '/' . $name);
    }

    public function loadScripts() {
		return $this->loadYAML('scripts.yaml');
    }

    public function restore($dump) {
    	if($this->utils)
			return $this->utils->restore($dump);
		else
			return false;
    }

	public function loadStackPanel($v) {
		$this->panelSet[$v] = array();
		$this->panelSet[$v]['fs'] = (file_exists($this->stacksPath . 'depot/' . $v . '/fieldset.yaml')) ? 
			Spyc::YAMLLoad($this->stacksPath . 'depot/' . $v . '/fieldset.yaml') : null;

		$this->panelSet[$v]['sp'] = (file_exists($this->stacksPath . 'depot/' . $v . '/panel.yaml')) ?
			Spyc::YAMLLoad($this->stacksPath . 'depot/' . $v . '/panel.yaml') : null;
	}

	public function distributeTemplates() {
		$dirs = array();
		$dirs['COLLECTIONS'] = array();
		$dirs['ITEMS'] = array();
		$dirs['PANELS'] = array();
		$dirs['STACKS'] = array();
		$dirs['PARAM'] = array();
		$tra = array();
		$flat = array();

		foreach (scandir($this->stacksPath . 'depot/') as $names) {
			if ('.' === $names || '..' === $names || '.DS_Store' === $names) continue;
			if(is_dir($this->stacksPath . 'depot/' . $names)) {

				//load the template file... if it has ISA command dristribute its name into COLLECTIONS or ITEMS
				$files = glob($this->stacksPath . 'depot/' . $names . '/*.tpl');
				foreach ($files as $file) {
					$n = array();
					preg_match('/\{{2}\!isa+:([CONDITIONAL|COLLECTION|ITEM]+)\}{2}/', file($file)[0], $n);
					if( is_string($n[1]) )
						if('COLLECTION' == $n[1] || 'ITEM' == $n[1])
//							array_push($dirs[$n[1].'S'], $names . '/' . pathinfo($file, PATHINFO_FILENAME));
							$dirs[$n[1].'S'][$names . '/' . pathinfo($file, PATHINFO_FILENAME)] = $names . '/' . pathinfo($file, PATHINFO_FILENAME);
							$dirs['STACKS'][$names] = ucwords($names);
				}

				if(file_exists($this->stacksPath . 'depot/' . $names . '/param.yaml'))
					$dirs['PARAM'][$names] = (file_exists($this->stacksPath . 'depot/' . $names . '/param.yaml')) ?
						Spyc::YAMLLoad($this->stacksPath . 'depot/' . $names . '/param.yaml') : array();


				$dirs['PANELS'][$names] = (file_exists($this->stacksPath . 'depot/' . $names . '/panel.yaml')) ?
					Spyc::YAMLLoad($this->stacksPath . 'depot/' . $names . '/panel.yaml') : array();

				if(is_array($dirs['PANELS'][$names]))
					array_walk_recursive($dirs['PANELS'][$names], function($val, $key) use (&$flat) {
						$flat[] = $key;
						$flat[] = $val;
					});
			}
		}
		return($dirs);
	}

	public function loadTemplatesIntoArray() {
		if(count($this->templates)>1) 
			return $this->templates;

		$this->templates = array();
		foreach (glob($this->stacksPath . 'depot/*.tpl') as $filename) {
//			echo($filename.'<br>');
			$this->templates[ pathinfo(basename($filename),PATHINFO_FILENAME) ] = file_get_contents($filename); 
		}
		foreach (glob($this->stacksPath . 'depot/*/*.tpl') as $filename) {
//			echo($filename.'<br>');
			$this->templates[ basename(dirname($filename)) . '/' . pathinfo(basename($filename),PATHINFO_FILENAME) ] = file_get_contents($filename); 
		}
	}
}