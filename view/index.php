
				
 <?php

 include("php/heading.php");
?>
      <div id="image">
				<img src="css/images/prva.jpg">
						</div>
						<div id="about">
							
							<span id="GFG_Span">Ukoliko nemate vremena za čitanje, nemate ni za pisanje</span>
              <br>
              <button style="color: white; background-color: #061A3A;"> Translate</button>
              </div>
      </div>
 
					<div id="footer">
			<p>Copyright &copy; FON <p>
		</div>
  </div>
<script>
  
function showResult(str) {    
  if (str.length==0) {
    document.getElementById("livesearch").innerHTML="";
    document.getElementById("livesearch").style.border="0px";
    return;
  }
  if (window.XMLHttpRequest) {
    xmlhttp=new XMLHttpRequest();
  } else {  
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange=function() {
    if (this.readyState==4 && this.status==200) {
      document.getElementById("livesearch").innerHTML=this.responseText;
      document.getElementById("livesearch").style.border="1px solid #A5ACB2";
    }
  }
  xmlhttp.open("GET","livesearch.php?q="+str,true);
  xmlhttp.send();
}

</script>
</body>
</html>