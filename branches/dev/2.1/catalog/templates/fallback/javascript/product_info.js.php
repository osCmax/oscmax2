<script language="javascript" type="text/javascript">
<!--// TABS -->
var panels=new Array('panel0', 'panel1','panel2','panel3','panel4','panel5','panel6');var selectedTab=null;function showPanel(tab,name)
{if(selectedTab)
{selectedTab.style.backgroundColor='';selectedTab.style.paddingTop='';selectedTab.style.marginTop='4px';}
selectedTab=tab;selectedTab.style.backgroundColor='white';selectedTab.style.paddingTop='6px';selectedTab.style.marginTop='0px';for(i=0;i<panels.length;i++)
document.getElementById(panels[i]).style.display=(name==panels[i])?'block':'none';return false;}
<!--// TABS-->
</script>