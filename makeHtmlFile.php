

<?php

//First attempt at creating an HTML file from a submitted article, with CIL styles applied

    $editor_data = $_POST[ 'editor1' ];
    $vol = $_POST[ 'vol' ];
    $no = $_POST[ 'no' ];
    $article_title = $_POST[ 'title' ];
    $article_subtitle = $_POST[ 'subtitle' ];
    $lastnameID = $_POST['lastname'];
    $article_authors = $_POST[ 'authors' ];
    $author_affiliation = $_POST['affiliation'];
    $abstract = $_POST['abstract'];
    $filename = $lastnameID.'_Vol'.$vol.'No'.$no.'.html';
    $fileLocation = '
    //path_to_file
    '.$filename;
    $reflist = '<div id="RefList"><h2 class="CILHead">References</h2>
    <!-- Enter reference list here -->
    <ul id="CILRefs">
    <li></li>
    <li></li>
    </ul></div>';
    
    
//Title Block

    $titleblock = '<div id="titleblock">
  <h1>'.$article_title.'</h1>'.

  '<h1 class="subtitle">'.$article_subtitle.'</h1>'.
  '<p class="author">'.$article_authors.', '.$author_affiliation.'</p>
  <!-- Can add more authors --> 
</div>';

//Body Block

    $bodyblock = '<div id="bodyblock">

<!-- Later, the abstract will be styled as an aside -->

  <div class="abstract">
    <p>'.$abstract.'</p>
  </div>';
  


if(isset($editor_data)) {
    $badtags = array("<p></p>", "<h2></h2>", "<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>", "<h2>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h2>");
    $editor_data = str_replace($badtags, "", $editor_data);
    $data = $editor_data;
    $data = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
  "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">'.
  '<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=windows-1252"/>'.
  '<title>Communications in Information Literacy - Vol. '.$vol.', no. '.$no.' - '.$article_title.'</title>'.
  '<!-- This is the link to the CIL Stylesheet. DO NOT CHANGE -->

<link href="../Styles/CILStyles.css" type="text/css" rel="stylesheet"/>
</head>'.
'<body>'.$titleblock.$bodyblock.$editor_data.$reflist.'</div></body>
</html>';

    $ret = file_put_contents($fileLocation, $data, FILE_APPEND | LOCK_EX);
   
    if($ret === false) {
        die('There was an error writing this file');
    }
    else {

        echo "$ret bytes written to file.";
        echo "Preview now: ".'<a href="http://www.cilpublications.org/sandbox/papers/'.$filename.'">Click</a>';
        
        
        
        
    }
    
    
}

 
else {
   die('no post data to process');
}


?>
