const form = document.querySelector('form');
const signup = document.getElementById('signup');

form.addEventListener("submit",(event)=>{
    event.preventDefault();
})


signup.onclick = () => {
    if(form.elements.terms.checked){
  var fullName = form.elements.fullName.value
  var Email = form.elements.Email.value;
  var Username = form.elements.Username.value;
  var Password = form.elements.Password.value;
  var rpassword = form.elements.RepeatPassword.value;
  var terms = form.elements.terms.checked;

console.log('clickedd')

    let xhr = new XMLHttpRequest();
    xhr.open('POST', "index.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded")
    xhr.send("fullName="+fullName + "&Email=" + Email + "&Username=" + 
    Username + "&Password=" + Password + "&RepeatPassword=" + rpassword + "&terms=" + terms);
    xhr.onload = () => {
      if(xhr.readyState === XMLHttpRequest.DONE){
        if(xhr.status === 200){
          let data = xhr.responseText;
          document.querySelector('.errMessage').innerHTML = data ;
        }
      }
    }
    // let formData = new formData(form);
    // xhr.send(formData);
  
    }
    else{
      document.querySelector('.errMessage').innerHTML = "You must agree to the terms of user to continue !";
    }
  }