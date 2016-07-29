<?php

    $editor_data = $_POST[ 'editor1' ];
    $vol = $_POST[ 'vol' ];
    $no = $_POST[ 'no' ];
    $article_title = $_POST[ 'title' ];
    $article_subtitle = $_POST[ 'subtitle' ];
    $article_author = $_POST[ 'author' ];
    $author_affiliation = $_POST['affiliation'];
    $filename = $article_author.'_'.$vol.'-'.$no.'.html';
    
//Title Block

    $titleblock = '<div id="titleblock">
  <h1>'.$article_title.'</h1>'.

  '<h1 class="subtitle">'.$article_subtitle.'</h1>'.
  '<p class="author">'.$article_author.', '.$author_affiliation.'</p>
  <!-- Can add more authors --> 
</div>';

//Body Block

    $bodyblock = '<div id="bodyblock">

<!-- Later, the abstract will be styled as an aside -->

  <div class="abstract">
    <p>'.$abstract.'</p>
  </div>';

if(isset($editor_data)) {
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
'<body>'.$titleblock.$bodyblock.$editor_data.'</body>
</html>';

    $ret = file_put_contents($filename, $data, FILE_APPEND | LOCK_EX);
    if($ret === false) {
        die('There was an error writing this file');
    }
    else {
        echo "$ret bytes written to file. Preview now: ".'<a href="http://www.cilpublications.org/sandbox/'.$filename.'">Click</a>';
    }
}
else {
   die('no post data to process');
}
?>