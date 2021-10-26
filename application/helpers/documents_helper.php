<?php
    if(!function_exists('document_icon'))
    {
        function document_icon($extencion, $type){
            switch($extencion){
                case "pdf": return "<img src='./img/iconos/pdf.png' width='25' height='28'>&nbsp;&nbsp;$type";break; 
                case "jpg": return "<img src='./img/iconos/jpg.png' width='25' height='28'>&nbsp;&nbsp;$type";break;
                case "png": return "<img src='./img/iconos/png.png' width='25' height='28'>&nbsp;&nbsp;$type";break;     
                case "docx": return "<img src='./img/iconos/docx.png' width='25' height='28'>&nbsp;&nbsp;$type";break;   
                case "xlsx": return "<img src='./img/iconos/xlsx.png' width='25' height='28'>&nbsp;&nbsp;$type";break;                                      
                case "jar": return "<img src='./img/iconos/jar.png' width='25' height='28'>&nbsp;&nbsp;$type";break;  
                case "html": return "<img src='./img/iconos/html.png' width='25' height='28'>&nbsp;&nbsp;$type";break;     
                case "exe": return "<img src='./img/iconos/exe.png' width='25' height='28'>&nbsp;&nbsp;$type";break;        
                case "rar": return "<img src='./img/iconos/rar.png' width='25' height='28'>&nbsp;&nbsp;$type";break;                                            
                case "mp4": return "<img src='./img/iconos/mp4.png' width='25' height='28'>&nbsp;&nbsp;$type";break;  
                case "aac": return "<img src='./img/iconos/acc.png' width='25' height='28'>&nbsp;&nbsp;$type";break; 
                case "ai": return "<img src='./img/iconos/ai.png' width='25' height='28'>&nbsp;&nbsp;$type";break;
                case "avi": return "<img src='./img/iconos/avi.png' width='25' height='28'>&nbsp;&nbsp;$type";break;
                case "bmp": return "<img src='./img/iconos/bmp.png' width='25' height='28'>&nbsp;&nbsp;$type";break;
                case "cda": return "<img src='./img/iconos/cda.png' width='25' height='28'>&nbsp;&nbsp;$type";break;
                case "cdr": return "<img src='./img/iconos/cdr.png' width='25' height='28'>&nbsp;&nbsp;$type";break;
                case "css": return "<img src='./img/iconos/css.png' width='25' height='28'>&nbsp;&nbsp;$type";break;
                case "db": return "<img src='./img/iconos/db.png' width='25' height='28'>&nbsp;&nbsp;$type";break;
                case "dmg": return "<img src='./img/iconos/dmg.png' width='25' height='28'>&nbsp;&nbsp;$type";break;
                case "doc": return "<img src='./img/iconos/doc.png' width='25' height='28'>&nbsp;&nbsp;$type";break;
                case "docm": return "<img src='./img/iconos/docm.png' width='25' height='28'>&nbsp;&nbsp;$type";break;
                case "dot": return "<img src='./img/iconos/dot.png' width='25' height='28'>&nbsp;&nbsp;$type";break;
                case "dotm": return "<img src='./img/iconos/dotm.png' width='25' height='28'>&nbsp;&nbsp;$type";break;
                case "dotx": return "<img src='./img/iconos/dotx.png' width='25' height='28'>&nbsp;&nbsp;$type";break; 
                case "dwf": return "<img src='./img/iconos/dwf.png' width='25' height='28'>&nbsp;&nbsp;$type";break; 
                case "dwg": return "<img src='./img/iconos/dwg.png' width='25' height='28'>&nbsp;&nbsp;$type";break;
                case "eps": return "<img src='./img/iconos/eps.png' width='25' height='28'>&nbsp;&nbsp;$type";break; 
                case "fla": return "<img src='./img/iconos/fla.png' width='25' height='28'>&nbsp;&nbsp;$type";break;
                case "flv": return "<img src='./img/iconos/flv.png' width='25' height='28'>&nbsp;&nbsp;$type";break; 
                case "gif": return "<img src='./img/iconos/gif.png' width='25' height='28'>&nbsp;&nbsp;$type";break;
                case "htm": return "<img src='./img/iconos/htm.png' width='25' height='28'>&nbsp;&nbsp;$type";break;
                case "info": return "<img src='./img/iconos/info.png' width='25' height='28'>&nbsp;&nbsp;$type";break; 
                case "ini": return "<img src='./img/iconos/ini.png' width='25' height='28'>&nbsp;&nbsp;$type";break; 
                case "java": return "<img src='./img/iconos/java.png' width='25' height='28'>&nbsp;&nbsp;$type";break;
                case "js": return "<img src='./img/iconos/js.png' width='25' height='28'>&nbsp;&nbsp;$type";break; 
                case "mid": return "<img src='./img/iconos/mid.png' width='25' height='28'>&nbsp;&nbsp;$type";break; 
                case "mkv": return "<img src='./img/iconos/mkv.png' width='25' height='28'>&nbsp;&nbsp;$type";break;
                case "mov": return "<img src='./img/iconos/mov.png' width='25' height='28'>&nbsp;&nbsp;$type";break; 
                case "mp3": return "<img src='./img/iconos/mp3.png' width='25' height='28'>&nbsp;&nbsp;$type";break; 
                case "mpg": return "<img src='./img/iconos/mpg.png' width='25' height='28'>&nbsp;&nbsp;$type";break; 
                case "odp": return "<img src='./img/iconos/odp.png' width='25' height='28'>&nbsp;&nbsp;$type";break;
                case "ods": return "<img src='./img/iconos/ods.png' width='25' height='28'>&nbsp;&nbsp;$type";break;
                case "odt": return "<img src='./img/iconos/odt.png' width='25' height='28'>&nbsp;&nbsp;$type";break;
                case "php": return "<img src='./img/iconos/php.png' width='25' height='28'>&nbsp;&nbsp;$type";break;
                case "pot": return "<img src='./img/iconos/pot.png' width='25' height='28'>&nbsp;&nbsp;$type";break;
                case "potm": return "<img src='./img/iconos/potm.png' width='25' height='28'>&nbsp;&nbsp;$type";break; 
                case "potx": return "<img src='./img/iconos/potx.png' width='25' height='28'>&nbsp;&nbsp;$type";break;
                case "pps": return "<img src='./img/iconos/pps.png' width='25' height='28'>&nbsp;&nbsp;$type";break;
                case "ppsm": return "<img src='./img/iconos/ppsm.png' width='25' height='28'>&nbsp;&nbsp;$type";break;
                case "ppsx": return "<img src='./img/iconos/ppsx.png' width='25' height='28'>&nbsp;&nbsp;$type";break;
                case "ppt": return "<img src='./img/iconos/ppt.png' width='25' height='28'>&nbsp;&nbsp;$type";break; 
                case "pptm": return "<img src='./img/iconos/pptm.png' width='25' height='28'>&nbsp;&nbsp;$type";break; 
                case "ppts": return "<img src='./img/iconos/ppts.png' width='25' height='28'>&nbsp;&nbsp;$type";break; 
                case "pptx": return "<img src='./img/iconos/pptx.png' width='25' height='28'>&nbsp;&nbsp;$type";break;
                case "ps": return "<img src='./img/iconos/ps.png' width='25' height='28'>&nbsp;&nbsp;$type";break;
                case "psd": return "<img src='./img/iconos/psd.png' width='25' height='28'>&nbsp;&nbsp;$type";break;
                case "pub": return "<img src='./img/iconos/pub.png' width='25' height='28'>&nbsp;&nbsp;$type";break; 
                case "rss": return "<img src='./img/iconos/rss.png' width='25' height='28'>&nbsp;&nbsp;$type";break; 
                case "rtf": return "<img src='./img/iconos/rtf.png' width='25' height='28'>&nbsp;&nbsp;$type";break; 
                case "sb2": return "<img src='./img/iconos/sb2.png' width='25' height='28'>&nbsp;&nbsp;$type";break;
                case "skp": return "<img src='./img/iconos/skp.png' width='25' height='28'>&nbsp;&nbsp;$type";break; 
                case "swf": return "<img src='./img/iconos/swf.png' width='25' height='28'>&nbsp;&nbsp;$type";break;
                case "sys": return "<img src='./img/iconos/sys.png' width='25' height='28'>&nbsp;&nbsp;$type";break; 
                case "tif": return "<img src='./img/iconos/tif.png' width='25' height='28'>&nbsp;&nbsp;$type";break; 
                case "txt": return "<img src='./img/iconos/txt.png' width='25' height='28'>&nbsp;&nbsp;$type";break;
                case "wav": return "<img src='./img/iconos/wav.png' width='25' height='28'>&nbsp;&nbsp;$type";break;
                case "wma": return "<img src='./img/iconos/wma.png' width='25' height='28'>&nbsp;&nbsp;$type";break; 
                case "wmv": return "<img src='./img/iconos/wmv.png' width='25' height='28'>&nbsp;&nbsp;$type";break; 
                case "xlsb": return "<img src='./img/iconos/xlsb.png' width='25' height='28'>&nbsp;&nbsp;$type";break; 
                case "xlsm": return "<img src='./img/iconos/xlsm.png' width='25' height='28'>&nbsp;&nbsp;$type";break; 
                case "xlt": return "<img src='./img/iconos/xlt.png' width='25' height='28'>&nbsp;&nbsp;$type";break; 
                case "xltm": return "<img src='./img/iconos/xltm.png' width='25' height='28'>&nbsp;&nbsp;$type";break; 
                case "xltx": return "<img src='./img/iconos/xltx.png' width='25' height='28'>&nbsp;&nbsp;$type";break;
                case "xml": return "<img src='./img/iconos/xml.png' width='25' height='28'>&nbsp;&nbsp;$type";break; 
                case "xts": return "<img src='./img/iconos/xts.png' width='25' height='28'>&nbsp;&nbsp;$type";break; 
                case "zip": return "<img src='./img/iconos/zip.png' width='25' height='28'>&nbsp;&nbsp;$type";break; 
                default: return "<img src='./img/iconos/gen.png' width='25' height='28'>&nbsp;&nbsp;$type";break;    
            }           
        }
    }

    if(!function_exists('get_file_format'))
    {
        function get_file_format($document_name){
            $split = explode(".", $document_name);
            return end($split);
        }
    }
?>