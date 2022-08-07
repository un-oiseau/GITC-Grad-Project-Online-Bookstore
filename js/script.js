$(document).ready(function(){
      $('.slider').bxSlider({
	  controls: false,
	  mode:'fade',
	  auto:true,
	  infiniteLoop:true,
	 responsive:true,
	 speed:1000,
	 oneToOneTouch:true,
	 shrinkItems:true
	  });	


$("#add_auth").click(function(){
	let a_name = $("#auth_name").val();
	let a_lname = $("#auth_lname").val();
	let wiki_link = $("#wiki_link").val();
	
	let is_v = true;
	
	let reg_url = /http(s?)(:\/\/)((www.)?)(([^.]+)\.)?([a-zA-z0-9\-_]+)(.com|.net|.gov|.org|.in)(\/[^\s]*)?/;
	
	if(a_name == "" || a_lname == ""){
		is_v = false;
		$(".auth_msg").html("Please fill name and last name");
	}
	
	else{
		$(".auth_msg").html("")
	}
	
	if(wiki_link !=""){
		if(!reg_url.test(wiki_link)){
			$(".auth_wiki").html("Please add valid url");
			is_v = false;
		}
		
		else{
			$(".auth_wiki").html("");
		}
	}
	
	if(is_v){
		let auth_data = {
			'a_name':a_name,
			'a_lname':a_lname,
			'wiki_link':wiki_link
			};
			
		$.ajax({
		url:'book_ajax.php',
		method:'post',
		data:auth_data,
		success:function(response){
		
		$("#auth_name").val("");
	    $("#auth_lname").val("");
	    $("#wiki_link").val("");
		
		$("#author_lists").html(response);
		
		}
		})
	}
	
});


   $("#file").change(function(){
	   let fileSize = this.files[0].size;
	   
	   if(fileSize/1024 > 5000){
		   $(".img_error").html("Max uploded file size should be 5MB");
		   $(this).val("");
	   }
	   
	   else{
		   $(".img_error").html("");
	   }
   });
   
   
	 $(".rmv_book").click(function(){
		 let id = $(this).attr('id');
		 let vdata = {'id':id}
		 let cnf = confirm("Are You Sure Want to Remove the Book From The List???");
		 
		 if(cnf){
			 $.ajax({
				url:'book_ajax.php',
				method:'post',
				data:vdata,
				success:function(response){
					alert(response);
				}					
			 })
		 }
	 }) 
	 
$("#sbs").click(function(){
	let sbs_email = $("#sbs_email").val();
	let vdata = {'sbs_email':sbs_email};
	$.ajax({
		url:'ajax.php',
				method:'post',
				data:vdata,
				success:function(response){
					$("#sbs_email").val("");
					$("#sbs_msg").html(response);
				}
	})
	
	return false;
});


$("#edit_prof").click(function(){
	
	let edit_valid = validateProfileEdit();
	
	if(!edit_valid){
		return false;
	}
})


	});    
function generatePassword(passLength){
let pass = document.getElementById("pass")
let res = "";
let symbols = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789=-!@#$%^&*()}{?";
for(let i = 0; i < passLength; i++){
let rnd = Math.floor(Math.random()*symbols.length);
res = res + symbols.charAt(rnd);
}
pass.value=res;
}

/*Validate Registration Form*/

document.querySelector("input[name='email']").onchange = function(){
	
	let mail = {'mail':this.value};
	
	$.ajax({
		url:'ajax.php',
		method:'post',
		data:mail,
		success:function(response){
			$(".error_email_ex").html(response);
		}
	})
}

function validateRegForm(){
	let name = document.querySelector("input[name='name']").value;
let lname = document.querySelector("input[name='lname']").value;
let city = document.querySelector("input[name='city']").value;
let email = document.querySelector("input[name='email']").value;
let pass = document.querySelector("input[name='password']").value;
let cnf_pass = document.querySelector("input[name='cnf_password']").value;

let is_valid = true;

 if(name == "" || lname == "" || city == "" || email == "" || pass == "" || cnf_pass == ""){
	 document.querySelector(".error_req").innerHTML = "Please Fill all required fields";
	 is_valid = false;
 } 

 else{
	 document.querySelector(".error_req").innerHTML = "";
 } 
 
 let reg =/^[a-zA-Z]+[a-zA-Z0-9._]+@[a-zA-Z_]+?\.[a-zA-Z]{2,6}$/;
 
 if(reg.test(email)){
	 document.querySelector('.error_email').innerHTML = "";
 } 
 else{	 
	 document.querySelector('.error_email').innerHTML  = "Invalid email address";
	 is_valid = false;
 }

 if(pass != "" && pass.length < 8){
	 document.querySelector('.error_pass_l').innerHTML  = "The symbols count should be 8 or more";
	  is_valid = false;
 }
 
 else{
	 document.querySelector('.error_pass_l').innerHTML = "";
 }
 
 if(pass != cnf_pass){
	 document.querySelector('.error_pass').innerHTML  = "Password and Confirm passwords are not identical";
	  is_valid = false;
 }
 
 else{
	 document.querySelector('.error_pass').innerHTML  = "";
 }
 
 if(document.querySelector('.error_email_ex').innerHTML !=""){
	 is_valid = false;
 }

  if(is_valid){
	  return true;
  }
  
  else{
	   return false;
  }
}

function validateProfileEdit(){
	let name = document.querySelector("input[name='name']").value;
let lname = document.querySelector("input[name='lname']").value;
let city = document.querySelector("input[name='city']").value;
let email = document.querySelector("input[name='email']").value;
let pass = document.querySelector("input[name='password']").value;

let is_valid = true;

 if(name == "" || lname == "" || city == "" || email == "" || pass == ""){
	 document.querySelector(".error_req").innerHTML = "Please Fill all required fields";
	 is_valid = false;
 } 

 else{
	 document.querySelector(".error_req").innerHTML = "";
 } 
 
 let reg =/^[a-zA-Z]+[a-zA-Z0-9._]+@[a-zA-Z_]+?\.[a-zA-Z]{2,6}$/;
 
 if(reg.test(email)){
	 document.querySelector('.error_email').innerHTML = "";
 } 
 else{	 
	 document.querySelector('.error_email').innerHTML  = "Invalid email address";
	 is_valid = false;
 }

 if(pass != "" && pass.length < 8){
	 document.querySelector('.error_pass_l').innerHTML  = "The symbols count should be 8 or more";
	  is_valid = false;
 }
 
 else{
	 document.querySelector('.error_pass_l').innerHTML = "";
 }
 
 
 if(document.querySelector('.error_email_ex').innerHTML !=""){
	 is_valid = false;
 }

  if(is_valid){
	  return true;
  }
  
  else{
	   return false;
  }
}


document.querySelector("#reg").onclick = function()	{
   
let valid = validateRegForm();
 
 if(!valid){
	 return false;
 }
	
}
		  