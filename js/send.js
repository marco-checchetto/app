const form = document.querySelector("#message-form"),
message = form.querySelector("#message").value,
inputField = form.querySelector("#message"),
sendBtn = form.querySelector("#send_message"),
chatBox = document.querySelector("#chat-messages");

form.onsubmit = (e)=>{
    e.preventDefault();
}

inputField.focus();
inputField.onkeyup = ()=>{
    if(inputField.value != ""){
        sendBtn.classList.add("active");
    }else{
        sendBtn.classList.remove("active");
    }
}

sendBtn.onclick = ()=>{
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "backend/send-message.php?message=" + inputField.value, true);
    xhr.onload = ()=>{
      if(xhr.readyState === XMLHttpRequest.DONE){
          if(xhr.status === 200){
              inputField.value = "";
              scrollToBottom();
          }
      }
    }
    let formData = new FormData(form);
    xhr.send(formData);
}

chatBox.onmouseenter = ()=>{
    chatBox.classList.add("active");
}

chatBox.onmouseleave = ()=>{
    chatBox.classList.remove("active");
}


// function loadDoc() {
//     let x = form["message-form"]["message"].value;
//     console.log(x);
//     document.getElementById("message").value = "";
//     let xhttp = new XMLHttpRequest();
//     xhttp.open("GET", "backend/send-message.php?message=" + x, true);
//     xhttp.onload = () => {
//         if (xhttp.readyState === XMLHttpRequest.DONE) {
//             if (xhttp.status === 200) {
//                 scrollToBottom();
//             }
//         }
//     }
//     xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
//     xhttp.send();
// }

if (chatBox.scrollTop !== chatBox.scrollHeight) {
}

setInterval(() =>{
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "messages.php", true);
    xhr.onload = ()=>{
      if(xhr.readyState === XMLHttpRequest.DONE){
          if(xhr.status === 200){
            let data = xhr.response;
            chatBox.innerHTML = data;
            if(!chatBox.classList.contains("active")){
                scrollToBottom();
              }
          }
      }
    }
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send();
}, 500);


function scrollToBottom(){
    chatBox.scrollTop = chatBox.scrollHeight;
  }

// setInterval(() =>{
//     let xhr = new XMLHttpRequest();
//     // xhr.open("POST", "php/get-chat.php", true);
//     xhr.onload = ()=>{
//       if(xhr.readyState === XMLHttpRequest.DONE){
//           if(xhr.status === 200){
//             let data = xhr.response;
//             chatBox.innerHTML = data;
//             if(!chatBox.classList.contains("active")){
//                 scrollToBottom();
//               }
//           }
//       }
//     }
//     xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
//     xhr.send();
// }, 500);