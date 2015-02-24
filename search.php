<?php
include 'SitterService.php';
session_start();
$sitterServices = array();
if (isset($_SESSION['sitterServices']) && isset($_SESSION['sitterServicesSubset']) && isset($_GET['p']) && !empty($_GET['p'])) {
    $currentPage = $_GET['p'];
    $sitterServices = $_SESSION['sitterServicesSubset'];

    include_once './searchResultsHandler.php';

    $sitterServices = searchResultsHandler::sortSitterServicesByPriceAscending($sitterServices);

    $sitterServices = searchResultsHandler::getResultsSubsetByPage($_SESSION['sitterServices'], $currentPage);

    if (!isset($_GET['p'])) {
        unset($_SESSION['sitterServices']);
    }
}
if (isset($_GET['error'])) {
    unset($_SESSION['sitterServices']);
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
        <title>Sitter Search</title>

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">


        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css">

        <style>
            /* CSS outside of media queries is a mobile first approach */
            #sortPanel {
                text-align: center;
            }

            #sortOptions {
                width: 100%;
            }

            /* Small devices (tablets, 768px and up) */
            @media (min-width: 768px) {
                button {
                    margin-top: 10px;
                }

                #sitterContainer {
                    margin-right: 10px;
                }

                #postcodeContainer {
                    margin-right: 10px;
                }

                #excludeContainer {
                    margin-top: 10px;
                }

                #radiusContainer {
                    margin: 10px 10px 0 0;
                }

                #sortPanel {
                    text-align: initial;
                }

                #sortOptions {
                    width: auto;
                }
            }

            /* Medium devices (desktops, 992px and up) */
            @media (min-width: 992px) {
                button {
                    margin-top: 10px;
                }

                #excludeContainer {
                    margin-top: 10px;
                }

                #radiusContainer {
                    margin: 0 10px 0 0;
                }
            }

            /* Large devices (large desktops, 1200px and up) */
            @media (min-width: 1200px) {
                button {
                    margin-top: 0;
                }

                #excludeContainer {
                    margin-top: 0;
                }
            }
        </style>

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>

    <body>

        <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <a class="navbar-brand" href="search.php">Sitter Search</a>
                </div>
            </div>
        </nav>

        <div class="container" style="margin-top: 80px;">
            <div class="row">
                <!--<div class="col-lg-6 col-lg-offset-3">-->
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <form class="form-inline text-center" action="searchHandler.php" method="POST">
                                <div class="form-group">
                                    <div id="sitterContainer" class="form-group">
                                        <label for="sitterType">Sitter Type</label>
                                        <select class="form-control" id="sitterType" name="sitterType">
                                            <option value="Babysitter">Babysitter</option>
                                            <option value="Petsitter">Petsitter</option>
                                            <option value="Housesitter">Housesitter</option>
                                            <option value="Plantsitter">Plantsitter</option>
                                            <option value="Catsitter">Catsitter</option>
                                            <option value="Dogsitter">Dogsitter</option>
                                            <option value="Grannysitter">Grannysitter</option>
                                        </select>
                                    </div>

                                    <div id="postcodeContainer" class="form-group">
                                        <label for="postcode">Postcode</label>
                                        <input type="text" class="form-control" id="postcode" name="postcode" placeholder="Enter a postcode">
                                    </div>

                                    <div id="radiusContainer" class="form-group">
                                        <label for="radius">Within radius (mi)</label>
                                        <select id="radiusList" name="radius" class="form-control">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="5">5</option>
                                            <option value="10">10</option>
                                            <option value="15">15</option>
                                        </select>
                                    </div>

                                    <div id="excludeContainer" class="form-group">
                                        <input type="checkbox" id="excludeImageCheck" name="excludeImageCheck">
                                        <span style="margin: 0 10px 0 5px;">Exclude posts without images</span>
                                    </div>

                                    <button type="submit" name="search" class="btn btn-default">Search</button>
                                </div>

                                <div class="panel panel-default" style="margin: 15px 0 0 0;">
                                    <div id="sortPanel" class="panel-body">
                                        <label id="sortLabel" for="sortOptions">Sort by:</label>
                                        <select class="form-control" id="sortOptions" name="sortOptions">
                                            <option value="asc">Price (Ascending)</option>
                                            <option value="desc">Price (Descending)</option>
                                        </select>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <?php
                foreach ($sitterServices as $sitterService) {
                    $imageUrl = 'images/NoPostImage.png';
                    $altText = 'NoPostImage.png';
                    if (count($sitterService->images) > 0) {
                        // Display first image in list as thumbnail for search result
                        $imageUrl = $sitterService->images[0]->url;
                        $altText = $sitterService->images[0]->$altText;
                    }
                    echo '
                        <div class="col-md-4">
                            <div class="thumbnail">
                                <a href="viewSitterService.php?id=' . $sitterService->postId . '">
                                    <img class="img-responsive" src="' . $imageUrl . '" alt="' . $altText . '" style="height: 233px; width: 350px;">
                                </a>
                                <div class="caption text-center">
                                    <a href="viewSitterService.php?id=' . $sitterService->postId . '">
                                        <h3>' . $sitterService->sittingType . ' | ' . $sitterService->postcode . ' | £' . $sitterService->rate . ' | ' . $sitterService->borough . '</h3>
                                    </a>
                                    <em>Posted by ' . $sitterService->username . '</em>
                                    <p style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">' . $sitterService->description . '</p>
                                </div>
                            </div>
                        </div>';
                }
                ?>
            </div>

            <nav class="text-center">
                <ul class="pagination">
                    <?php
                    if (isset($_GET['p']) && !empty($_GET['p'])) {
                        if ($_GET['p'] == 1) {
                            echo '<li class="disabled"><a href="#" aria-label="Previous" onclick="event.preventDefault();"><span aria-hidden="true">&laquo;</span></a></li>';
                        } else {
                            echo '<li><a href="search.php?p=' . ($_GET['p']-1) . '" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>';
                        }

                        include_once './searchResultsHandler.php';
                        $pages = ceil(count($_SESSION['sitterServices']) / searchResultsHandler::$RESULTS_PER_PAGE);
//                        print_r($_SESSION['sitterServices']);exit;
//                        echo 'count - '.count($_SESSION['sitterServices']).' pages - '.$pages;exit;
                        for ($i = 1; $i <= $pages; $i++) {
                            if ($i == $_GET['p']) {
                                echo '<li class="active"><a href="#">' . $i . '<span class="sr-only">(current)</span></a></li>';
                            } else {
                                echo '<li><a href="search.php?p=' . $i . '">' . $i . '</a></li>';
                            }
                        }
                        if ($pages == $_GET['p']) {
                            echo '<li class="disabled"><a href="#" aria-label="Next" onclick="event.preventDefault();"><span aria-hidden="true">&raquo;</span></a></li>';
                        } else {
                            echo '<li><a href="search.php?p=' . ($_GET['p']+1) . '" aria-label="Next"><span aria-hidden="true">&raquo;</span></a></li>';
                        }
                    }
                    ?>
                </ul>
            </nav>
        </div><!--/.container -->


        <!--Bootstrap core JavaScript
        ================================================== -->
        <!--Placed at the end of the document so the pages load faster -->
        <script src = "https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
        <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
        <script src="http://getbootstrap.com/assets/js/ie10-viewport-bug-workaround.js"></script>
    </body>
</html>