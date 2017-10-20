<?php 
    /**
     * [scanDirectories Obtention des repertoire]
     * @param  [type] $rootDir [description]
     * @param  array  $allData [description]
     * @return [type]          [description]
     */
    function scanDirectories($rootDir, $allData=array()) {
        $invisibleFileNames = array(".", "..", ".htaccess", ".htpasswd");
        $dirContent = scandir($rootDir);
        foreach($dirContent as $key => $content) {
            $path = $rootDir.'/'.$content;
            if(!in_array($content, $invisibleFileNames)) {
                if(is_dir($path) && is_readable($path)) {
                    $allData[] = $path;
                    $allData = scanDirectories($path, $allData);
                }
            }
        }
        return $allData;
    }
    function createTree($categories){
        $html = "";
        foreach ($categories as $value) {
            $html .= "<li><a href='#'>".$value["libelle"]."</a>";
            if(count($value["children"])>0)
            {
                $html.="<ul>";
                $html.= createTree($value["children"]);
                $html.="</ul>";
            }
            $html.="</li>";
        }
        $html.="</li>";
        return $html;
    }
    /**
     * [__autoload autoload des classes]
     * @param  [type] $class_name [description]
     * @return [type]             [description]
     */
   function __autoload($class_name){
        $dir = scanDirectories($_SERVER['DOCUMENT_ROOT']);
        foreach($dir as $value){
            if(file_exists($value."/".lcfirst($class_name).".php")){
                require $value."/".lcfirst($class_name).".php";
                return;
            }
            if(file_exists($value."/".ucfirst($class_name).".php")){
                require $value."/".ucfirst($class_name).".php";
                return;
            }
            if(file_exists($value."/".lcfirst($class_name).".class.php")){
                require $value."/".lcfirst($class_name).".class.php";
                return;
            }
            if(file_exists($value."/".ucfirst($class_name).".php")){
                require $value."/".ucfirst($class_name).".php";
                return;
            }
        }
        throw new Exception("Impossible de charger la classe ".$class_name);
        
    }
?>