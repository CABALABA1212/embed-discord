<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Embed Link Generator</title>
    <?php
        $title = isset($_GET['title']) ? htmlspecialchars($_GET['title']) : 'Default Title';
        $text = isset($_GET['text']) ? htmlspecialchars($_GET['text']) : 'Default Text';
        $color = isset($_GET['color']) ? htmlspecialchars($_GET['color']) : '#000000';
    ?>
    <meta property="og:title" content="<?php echo $title; ?>" />
    <meta property="og:description" content="<?php echo $text; ?>" />
    <meta property="og:image" content="URL_TO_IMAGE" />
    <meta property="og:url" content="<?php echo 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>" />
    <style>
        body {
            background-color: <?php echo $color; ?>;
            color: <?php echo getTextColor($color); ?>;
        }
    </style>
</head>
<body>
    <h1 id="title"><?php echo $title; ?></h1>
    <p id="text"><?php echo $text; ?></p>

    <h1>Generate Embed Link</h1>
    <form id="generateForm" method="GET" action="">
        <label for="title">Title:</label>
        <input type="text" id="title" name="title"><br><br>
        <label for="text">Text:</label>
        <input type="text" id="text" name="text"><br><br>
        <label for="color">Background Color:</label>
        <input type="color" id="color" name="color" value="#000000"><br><br>
        <button type="submit">Generate Link</button>
    </form>
    <p id="generatedLink">
        <?php
            if (isset($_GET['title']) && isset($_GET['text']) && isset($_GET['color'])) {
                $generatedUrl = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
                echo '<a href="' . $generatedUrl . '" target="_blank">' . $generatedUrl . '</a>';
            }
        ?>
    </p>

    <?php
    function getTextColor($bgColor) {
        $color = ltrim($bgColor, '#');
        $r = hexdec(substr($color, 0, 2));
        $g = hexdec(substr($color, 2, 2));
        $b = hexdec(substr($color, 4, 2));
        $brightness = ($r * 299 + $g * 587 + $b * 114) / 1000;
        return $brightness < 128 ? '#FFFFFF' : '#000000';
    }
    ?>
</body>
</html>
