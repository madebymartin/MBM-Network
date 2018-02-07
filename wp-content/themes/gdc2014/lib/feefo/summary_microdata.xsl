<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
                version="1.0">
    <xsl:output method="xml" omit-xml-declaration="yes"/>
    <xsl:template match="/">

    <xsl:for-each select="FEEDBACKLIST/SUMMARY">
        <div itemtype="http://data-vocabulary.org/Review-aggregate" itemscope="itemscope" class="cat_box">
            <div>
                <strong class="left">Average Customer Rating</strong>
                <div class="rating-box left">
                    <div style="width:97%" class="rating">
                        <img alt="Feefo Star Rating" title="Feefo Star Rating">
                            <xsl:attribute name="src"><xsl:value-of select="concat('http://cdn.feefo.com/feefo/feefologo.jsp?logon=',VENDORLOGON,'&amp;template=bvgos.png')" /></xsl:attribute>
                        </img>
                    </div>
                </div>
                <strong class="left"><xsl:value-of select="AVERAGE div 20" /> out of 5</strong>
                <div class="clearer"></div>
            </div>
            <span itemprop="itemreviewed"><xsl:value-of select="TITLE" /></span>
            <span class="review-aggregate-rating" itemtype="http://data-vocabulary.org/Rating" itemscope="" itemprop="rating">
                <span> in this category have an average rating of <strong><span itemprop="average"><xsl:value-of select="AVERAGE div 20" /></span>  out of <span itemprop="best">5</span></strong>, based on <strong><span><xsl:value-of
                        select="TOTALSERVICECOUNT" /></span> customer reviews</strong></span>
            </span>
            <xsl:variable name="tsc">
                <xsl:value-of select="TOTALSERVICECOUNT" />
            </xsl:variable>
            <meta itemprop="votes" content="{$tsc}" />



            <meta itemprop="count" content="{$tsc}" />



        </div>
    </xsl:for-each>
    </xsl:template>
</xsl:stylesheet>