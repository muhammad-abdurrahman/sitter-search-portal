<?php
include 'XmlDom.php';
include 'xmlToSitterServiceParser.php';

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];
    $webServiceUrl = 'http://stu-nginx.cms.gre.ac.uk/~am238/WebServices/getPostsById.php?id=' . $id;
    $sitterServices = xmlToSitterServiceParser::getSitterServicesFromXml(XmlDom::getXmlDom($webServiceUrl));
    if (count($sitterServices) > 0) {
        $post = $sitterServices[0];
    } else {
        header('Location: search.php?error=true');
        exit;
    }
} else {
    header('Location: search.php?error=true');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>View Sitter Service</title>

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">

        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css">

        <style>
            .borderless tbody tr td, .borderless tbody tr th, .borderless thead tr th {
                border: none;
            }
        </style>

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>

    <body style="background-color: #eee;">

        <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#">View Sitter Service</a>
                </div>
            </div>
        </nav>

        <div class="container" style="margin-top: 80px;">
            <div class="col-lg-6 col-md-8 col-lg-offset-3 col-md-offset-2 img-rounded" style="background-color: #fff; padding: 20px; margin-bottom: 30px;">
                <table class="table borderless">
                    <tbody><tr>
                            <th>Username</th>
                            <td>
                                <p><?= $post->username ?></p>
                            </td>
                        </tr>
                        <tr>
                            <th>Sitting Type</th>
                            <td>
                                <p><?= $post->sittingType ?></p>
                            </td>
                        </tr>

                        <tr>
                            <th>Postcode</th>
                            <td>
                                <p id="postcode"><?= $post->postcode ?></p>
                            </td>
                        </tr>

                        <tr>
                            <th>Price</th>
                            <td>
                                <p>£<?= $post->rate ?></p>
                            </td>
                        </tr>

                        <tr>
                            <th>Availability</th>
                            <td>
                                <p><?= $post->availability ?></p>
                            </td>
                        </tr>

                        <tr>
                            <th>Description</th>
                            <td>
                                <p><?= $post->description ?></p>
                            </td>
                        </tr>

                        <tr id="mapImageRow">
                            <th>Map</th>
                            <td>
                                <img class="img-responsive" src="http://maps.google.com/maps/api/staticmap?center=<?= $post->postcode ?>&amp;zoom=14&amp;size=397x300&amp;maptype=roadmap&amp;markers=color:ORANGE|label:A|<?= $post->postcode ?>&amp;sensor=false" alt="Map of <?= $post->postcode ?>">
                            </td>
                        </tr>

                        <tr>
                            <th>Images</th>
                            <td>
                                <?php
                                foreach ($post->images as $image) {
                                    echo '
                                        <a href = "' . $image->url . '" target = "_blank">
                                            <img class = "img-responsive img-rounded" src = "' . $image->url . '" alt = "' . $image->altText . '" height = "200" width = "200">
                                        </a><br />';
                                }
                                ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div><!-- /.container -->


        <!-- Bootstrap core JavaScript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
        <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
        <script src="http://getbootstrap.com/assets/js/ie10-viewport-bug-workaround.js"></script>
    </body>
</html>