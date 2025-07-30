
<?php
// 随机模板随机干扰标签内容生成

function addCustomTags($content) {
    while (strpos($content, "{randTOTag}") !== false) {
        //$content = str_replace("{randTOTag}", generateRandomTagContent(), $content);
        $content = preg_replace("/\{randTOTag\}/", generateRandomTagContent(), $content, 1);
    }
    return $content;
}

function generateRandomTagContent() {
    $tags = ["divYY", "pYYY", "spanYYY"]; //******！！！需要手工设置 干扰标签列表：******　为了测试方便加的YYY
    
    $randomContent = "";
    $randomCount = rand(1, 10);

    for ($i = 0; $i < $randomCount; $i++) {
        $randomTag = $tags[array_rand($tags)];
        $randomContent .=  '<'.$randomTag . ' id="' . generateRandomString() . '" class="' . generateRandomString() . '">' . '</' . $randomTag. '>';
    }

    return $randomContent;
}

function generateRandomString($length = 10) {
    $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $randomString = '';
    $charactersLength = strlen($characters);

    $randomLength = rand(4, $length);

    for ($i = 0; $i < $randomLength; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }

    return $randomString;
}

function getAllTagPositions($htmlSource, $tag) {
    $positions = [];
    $startPosition = 0;
    while (($position = strpos($htmlSource, $tag, $startPosition)) !== false) {
        $positions[] = $position;
        $startPosition = $position + strlen($tag);
    }
    return $positions;
}



function getNewHTML($htmlSource) {
    //暂时用 div,p作标记点，也可考虑增加　<!--　<img 等
    if (strpos($htmlSource, "</div>") !== false || strpos($htmlSource, "</p>") !== false) {
        $positions = [];
        if (strpos($htmlSource, "</div>") !== false) {
            $divPositions = getAllTagPositions($htmlSource, "</div>");
            $positions = array_merge($positions, $divPositions);
        }
        if (strpos($htmlSource, "</p>") !== false) {
            $pPositions = getAllTagPositions($htmlSource, "</p>");
            $positions = array_merge($positions, $pPositions);
        }
        
        $randomNumber = rand(2, 10);
        for ($i = 1; $i <= $randomNumber; $i++) {
            $randomPosition = $positions[array_rand($positions)];    
            $htmlSource = substr_replace($htmlSource, "{randTOTag}", $randomPosition, 0);

            $positions = [];    
            if (strpos($htmlSource, "</div>") !== false) {
                $divPositions = getAllTagPositions($htmlSource, "</div>");
                $positions = array_merge($positions, $divPositions);
            }
            if (strpos($htmlSource, "</p>") !== false) {
                $pPositions = getAllTagPositions($htmlSource, "</p>");
                $positions = array_merge($positions, $pPositions);
            }
    
        }
    
    }//endif     
   
    $fileContent = addCustomTags($htmlSource);  
    return $fileContent;
}

//主程序　调用上面方法
// 2. 从指定的“模板文件夹”中读取所有的 .html 文件
$templateFolder = "./muban"; //******！！！需要手工设置文件夹路径：******
$files = glob($templateFolder . "/*.html");
$randomFile = $files[array_rand($files)];
// echo($randomFile);
// exit();
$htmlSource = file_get_contents($randomFile);


$newHTML=getNewHTML($htmlSource); //调用主函数　取得新模板HTML

//测试输出
echo $newHTML;

?>
