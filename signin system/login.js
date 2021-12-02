function validate()
{
var username=document.getElementById("username").nodeValue;
var password=document.getElementById("password")
if(username=="admin"&& password=="user") 
{
  alert("login succesfully");
  return false;
}
else
{
  alert("login failed");
}
  
  
  
  
  
  
}
