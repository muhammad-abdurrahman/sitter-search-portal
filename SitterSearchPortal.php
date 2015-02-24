<html>
    <head>
        <link href="styles/styles.css" rel="stylesheet" type="text/css"/>
        <title>
            SitterService Search Portal
        </title></head>
    <body>
        <div id="content">
            <p class="heading1">SitterService Search Portal</p><br>
            <span>
                <p class="intro">Click <a href="index.php">here</a> for a complete list of operations.</p>
                <h2><?= $_REQUEST['op'] ?></h2>
                <p class="intro"></p>
                <h3>Test</h3>
                To test the operation using the HTTP POST protocol, click the 'Invoke' button.
                <form target="_blank" action='http://stu-nginx.cms.gre.ac.uk/~am238/WebServices/<?= $_REQUEST['op'] ?>.php' method="POST">                      
                    <table cellspacing="0" cellpadding="4" frame="box" bordercolor="#dcdcdc" rules="none" style="border-collapse: collapse;">
                        <?php
                        include 'WebServices.php';
                        $services = WebServices::getServices();
                        if (sizeof($services[$_REQUEST['op']]) > 0) {
                            echo '<tr>
                        <td class = "frmHeader" background = "#dcdcdc" style = "border-right: 2px solid white;">Parameter</td>
                        <td class = "frmHeader" background = "#dcdcdc">Value</td>
                        </tr>';
                        }

                        foreach ($services[$_REQUEST['op']] as $parameter) {
                            echo '<tr>'
                            . '<td class = "frmText" style = "color: #000000; font-weight: normal;">' . $parameter->name . ':</td>'
                            . '<td><input class = "frmInput" type = "text" size = "50" name = "' . $parameter->name . '"></td>'
                            . '</tr>';
                        }
                        ?>
                        <tr>
                            <td></td>
                            <td align="right"> <input type="submit" value="Invoke" class="button"></td>
                        </tr>
                    </table>
                </form>
            </span>
    </body>
</html>
