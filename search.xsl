<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    <xsl:template match="/">
        <html lang="en">
            <head>
                <meta charset="utf-8"/>
                <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
                <meta name="viewport" content="width=device-width, initial-scale=1"/>
                <meta name="description" content=""/>
                <meta name="author" content=""/>
                <title>Sitter Search</title>

                <!-- Latest compiled and minified CSS -->
                <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css"/>

                <!-- Optional theme -->
                <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css"/>

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
                            <a class="navbar-brand" href="searchx.php">Sitter Search</a>
                        </div>
                    </div>
                </nav>

                <div class="container" style="margin-top: 80px;">
                    <div class="row">
                        <!--<div class="col-lg-6 col-lg-offset-3">-->
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <form class="form-inline text-center" action="searchx.php" method="POST">
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
                                                <input type="text" class="form-control" id="postcode" name="postcode" placeholder="Enter a postcode"/>
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
                                                <input type="checkbox" id="excludeImageCheck" name="excludeImageCheck"/>
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
                                                <input type="checkbox" name="clientXslt" value="1" style="margin: 0 5px 0 15px;"/>
                                                <span>Use client side xslt</span>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                
                        <xsl:choose>
                            <xsl:when test="//Sitter">
                                <xsl:for-each select="//Sitter">
                                    <xsl:variable name="postId" select="./SitterService/@id"/>
                                    <xsl:variable name="userId" select="./@id"/>
                                    <xsl:variable name="username" select="./Username"/>
                                    <xsl:variable name="email" select="./EmailAddress"/>
                                    <xsl:variable name="fullName" select="./FullName"/>
                                    <xsl:variable name="postcode" select="./SitterService/Postcode"/>
                                    <xsl:variable name="description" select="./SitterService/Description"/>
                                    <xsl:variable name="availability" select="./SitterService/Availability"/>
                                    <xsl:variable name="rate" select="./SitterService/Rate"/>
                                    <xsl:variable name="calloutCharge" select="./SitterService/CalloutCharge"/>
                                    <xsl:variable name="sittingType" select="./SitterService/@type"/>
                                    <xsl:variable name="borough" select="./SitterService/@borough"/>
                                    
                                    <xsl:choose>
                                        <xsl:when test=".//Image">
                                            <xsl:variable name="url" select="./SitterService/ImageList[1]/Image[1]/Url"/>
                                            <xsl:variable name="altText" select="./SitterService/ImageList[1]/Image[1]/AltText"/>
                                            <div class="col-md-4">
                                                <div class="thumbnail">
                                                    <a href="viewSitterService.php?id={$postId}">
                                                        <img class="img-responsive" src="{$url}" alt="{$altText}" style="height: 233px; width: 350px;"/>
                                                    </a>
                                                    <div class="caption text-center">
                                                        <a href="viewSitterService.php?id={$postId}">
                                                            <h3>
                                                                <xsl:value-of select="$sittingType"/> | <xsl:value-of select="$postcode"/> | £<xsl:value-of select="$rate"/> | <xsl:value-of select="$borough"/>
                                                            </h3>
                                                        </a>
                                                        <em>Posted by <xsl:value-of select="$username"/></em>
                                                        <p style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                                            <xsl:value-of select="$description"/>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </xsl:when>
                                        <xsl:otherwise>
                                            <div class="col-md-4">
                                                <div class="thumbnail">
                                                    <a href="viewSitterService.php?id={$postId}">
                                                        <img class="img-responsive" src="images/NoPostImage.png" alt="NoPostImage.png" style="height: 233px; width: 350px;"/>
                                                    </a>
                                                    <div class="caption text-center">
                                                        <a href="viewSitterService.php?id={$postId}">
                                                            <h3>
                                                                <xsl:value-of select="$sittingType"/> | <xsl:value-of select="$postcode"/> | £<xsl:value-of select="$rate"/> | <xsl:value-of select="$borough"/>
                                                            </h3>
                                                        </a>
                                                        <em>Posted by <xsl:value-of select="$username"/></em>
                                                        <p style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                                            <xsl:value-of select="$description"/>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </xsl:otherwise>
                                    </xsl:choose>
                                </xsl:for-each>
                            </xsl:when>
                            <xsl:otherwise>
                                <div></div>
                            </xsl:otherwise>
                        </xsl:choose>
                        
                    </div>
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
        
    </xsl:template>
</xsl:stylesheet>