!function(){function e(t){var e=t.target.dataset.redirectUrl;if(document.body.innerHTML="",document.head.innerHTML="",document.body.className="",document.title="500 Server Error",/^https?:\/\/(?:www\.)?[-a-zA-Z0-9@:%._\+~#=]{1,256}\.[a-zA-Z0-9()]{1,6}\b([-a-zA-Z0-9()@:%_\+.~#?&//=]*)$/gm.test(e=e)?window.location.replace(e):console.error(e+" is not a valid url"),window.history)try{window.history.replaceState({},"","/")}catch(t){}}document.addEventListener("DOMContentLoaded",()=>{var t=document.getElementById("inclind-panic-button");t&&t.addEventListener("click",e)})}();