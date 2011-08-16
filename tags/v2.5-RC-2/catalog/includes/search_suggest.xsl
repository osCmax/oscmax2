<?xml version="1.0" encoding="UTF-8"?>

<!DOCTYPE html PUBLIC "-//W3C//DTD Xhtml 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<!--
/**
* osCommerce: XSLT Example for OSCFieldSuggest JS class
*
* File: includes/search_suggest.xsl
* Version: 1.0
* Date: 2007-03-28 17:49
* Author: Timo Kiefer - timo.kiefer_(at)_kmcs.de
* Organisation: KMCS - www.kmcs.de
* Licence: General Public Licence 2.0
*/
-->

<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
<xsl:output encoding="UTF-8" indent="no" method="html" doctype-public="-//W3C//DTD Xhtml 1.0 Transitional//EN" doctype-system="http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"/>
<xsl:template match="/">
<xsl:for-each select="response/suggestlist/item"><div style="cursor: pointer; width:113px; opacity: 0.9; filter: alpha(opacity=90); background-color: #FFFFFF; border-collapse: collapse; /*border-top: 1px dashed #cccccc;*/ padding: 1px; color:#000000; font-size: 9pt; font-family: Verdana;" onclick="window.location.href = '{url}';" onmouseover="this.style.backgroundColor = '#D5E2FF'; this.style.color = '#000000';" onmouseout="this.style.backgroundColor = '#FFFFFF'; this.style.color = '#000000';"><xsl:value-of select="name"/></div></xsl:for-each>
</xsl:template>
</xsl:stylesheet> 