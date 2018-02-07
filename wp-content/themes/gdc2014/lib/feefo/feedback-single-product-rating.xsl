<?xml version="1.0" encoding="ISO-8859-1" ?> 
<?xml-stylesheet type="text/css" href="style.css"?>
 <html xsl:version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform" >
    <xsl:variable name="feefostarsimageroot" select="'https://germaine-de-capuccini.co.uk/feefo/rating'" />
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>FeeFo Feedback</title>
</head>
  <body>
    <xsl:for-each select="FEEDBACKLIST/SUMMARY">
           <div class="woocommerce-product-rating" itemtype="https://schema.org/AggregateRating" itemscope="itemscope" itemprop="aggregateRating">

              <div class="star-rating" title="Rated 5.00 out of 5">
                <span style="width:100%">
                  <strong itemprop="ratingValue" class="rating">5.00</strong> out of <span itemprop="bestRating">5</span> based on <span itemprop="ratingCount" class="rating">2</span> customer ratings
                </span>


                <a href="#reviews" class="woocommerce-review-link" rel="nofollow">(<span itemprop="reviewCount" class="count">4</span> customer reviews)</a>  
              </div>

           </div>
    </xsl:for-each>
  </body>
</html>
