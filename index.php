<?php
	$jsonQuote = file_get_contents('https://inspiration.goprogram.co.uk/');
	$quoteAPI = json_decode($jsonQuote,true);
    $author = $quoteAPI['author'];
    $quote = $quoteAPI['quote'];
?>
<!--
-->
<html>
<head>
    <link href="style.css" rel="stylesheet" type="text/css">
</head>
<body>
<div class="containerbox">
    <h1>Web Application(Using API)</h1>
    <div class="content">
    <div class="quoteBox">
            <p id="quoteR">"<?php echo $quote;?>"</p>
            <p id="authorR">-<?php echo $author;?></p>
    </div>
    <div class="info">
        <p>This web application uses two APIS which are: Inspiration and a calculator API. The Inpiration API is an api that generates
        random quotes every hour. Here's the <a href="https://inspiration.goprogram.co.uk/docs">link</a> 
        for the  first api used in this web app. The second api used in this web application is a simple calculator 
        that can do operations in math like simplify, factor, trigonomial functions and their arc functions, and absolute value.
        More information of the Api can be seen <a href="https://github.com/aunyks/newton-api">here</a>.
        To avoid errors in the calculation:
        </p>
        <ul>
            <li>Use '^' to indicate an exponent</li>
            <li>For simple operations just use +,-,*,(over)=division</li>
            <li>Avoid using spaces in the input box as much as posible</li>
        </ul>
    </div>
    </div>
    <div class="calcuBox">
<form action="index.php" method="get">
    <label for="ope">Choose an operation:</label>
        <select id="ope" name="op">
            <option value="simplify">Simplify</option>
            <option value="factor">Factor</option>
            <option value="cos">Find Cosine</option>
            <option value="sin">Find Sine</option>
            <option value="tan">Find Tangent</option>
            <option value="arccos">Find Inverse Cosine</option>
            <option value="arcsin">Find Inverse Sine</option>
            <option value="arctan">Find Inverse Tangent</option>
            <option value="abs">Absolute Value</option>
        </select>
        <label for="expression"> Input: </label>
        <input type="text" id="expression" name="exp">
        <input type="submit" name="submit" value="Calculate">
</form>
<?php
    error_reporting(E_ERROR | E_PARSE);
    if(isset($_REQUEST['submit'])){
        $op=$_REQUEST['op'];
        $exp=$_REQUEST['exp'];
        $exp= str_replace("+","%2B",$exp);
        $jsonNewton = file_get_contents('https://newton.now.sh/api/v2/'.$op.'/'.$exp);
        $calcuApi= json_decode($jsonNewton, true);
        $result= $calcuApi['result'];
        if(isset($result)){
            echo "<div class='result'>The answer is: ".$result."</div>";
        }
        else{
            echo "There's something wrong with your equation. Kindly double check and try again.";
        }
    }
    ?>
    </div>
</div>
</body>
</html>