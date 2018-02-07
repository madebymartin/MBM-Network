<%@ Page Language="C#" %>
<%@ Import Namespace="System.Xml" %>
<%@ Import Namespace="System.Xml.Xsl" %>
<%@ Import Namespace="System.Xml.XPath" %>

<%
// This is the ASP.NET C# implementation of feefofeedback.php
// The following comments have been copied from that document:
//
// The principal possible parameters passed here are logon and limit. 
//  vendorref can be used if you want the feedback for particular products, for which you have sent unique vendorrefs 
//  vendorref may contain wildcards  (e.g.   *SKU1234*  would pick up a feedback on 'SKU1234 THURSDAY'
//  You could also pass various other parameters - see the parameters passed at the top of the feedback viewing page on the Feefo site.
//  have added mode, can be product or service or both
%>

<script runat="server">                
    void Page_Load(object sender, System.EventArgs e)
  {
		string logon = Request["logon"];
		string limit = Request["limit"];
		string mode = Request["mode"];
		string vendorref = Request["vendorref"];
		string xml_filename = "http://www.feefo.com/feefo/xmlfeed.jsp?logon="+logon;
        string xslPath = MapPath("feedback.xsl"); //xsl document in same working directory as this page
		
		if(limit!=null) xml_filename += "&limit=" + limit;
		if(mode!=null) xml_filename += "&mode=" + mode;
		if(vendorref!=null) xml_filename += "&vendorref=" + vendorref;
		
        XPathDocument xpathDoc = new XPathDocument(xml_filename);      
		XslCompiledTransform transform = new XslCompiledTransform();                    
        transform.Load(xslPath);                
        transform.Transform(xpathDoc, null, Response.Output);            
    }        
</script>
