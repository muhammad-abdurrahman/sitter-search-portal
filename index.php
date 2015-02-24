<html>
    <head>
        <meta charset="UTF-8">
        <link href="styles/styles.css" rel="stylesheet" type="text/css"/>
        <title>
            SitterService Search Portal
        </title>
    </head>
    <body>
        <div id="content">
            <p class="heading1">SitterService Search Portal</p><br>
            <span>
                <!--<p class="intro">The following operations are supported.  For a formal definition, please review the <a href="#">Service Description</a>. </p>-->
                <p> </p>
                <ul>
                    <?php
                    include 'WebServices.php';
                    $services = WebServices::getServices();

                    foreach (array_keys($services) as $service) {
                        echo '<li>
                            <a href="SitterSearchPortal.php?op=' . $service . '">' . $service . '</a>
                            </li>
                            <p>';
                    }
                    ?>
                </ul>
            </span>
    </body>
</html>
