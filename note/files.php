<?php
    if(isset($_REQUEST['createnew'])){
        $catname="_files\\".$_REQUEST['catname'];
        $filename=$_REQUEST['filename'];
        if($catname=='')$catname='default';
        if($filename=='')$filename=time();
        
        if(file_exists($catname)&is_dir($catname)){
            $rawfile=fclose(fopen($catname."\\".$filename,'a'));
        }else{
            mkdir($catname);
            $rawfile=fclose(fopen($catname."\\".$filename,'a'));
        }
    }

    function list_dir($path,$tab){
        $sub=scandir($path);
        for ($i1=2;$i1<count($sub);$i1++){
            $rand=rand(1000000,9999999);
            print("<div class='files'>");
            if(is_dir($path.'\\'.$sub[$i1])){
                print("<div id='tabhead$rand' onclick='tabchange(this.id);'>".$sub[$i1]."</div>");
                print("<div id='tabbody$rand' style='display:block;display:none;vertical-align:top;overflow:hidden'>");
                list_dir($path.'\\'.$sub[$i1], $tab."\t");
                print("</div>");
            }
            else{
                $id=str_replace("\\",":",$path.'\\'.$sub[$i1]);
                //$id=str_replace(".","",$id);
                print("<button id='".$id."' onclick='getThis(this.id);'>".$sub[$i1]."</button>");
            }
            print("</div>");
        }
    }
    print("<div id=\"browser\">");
    $main='_files';$tab="\t";
    list_dir($main, $tab);
    print("</div>"); 
?>
