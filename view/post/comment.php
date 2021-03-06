<?php

// Post ID:
$postID = get('id'); ?>
<div id="root"></div>

<script type="text/javascript">

    /**
     * @Author Emir Furkan Bilici <efurkanbilici@gmail.com>
     */
    class Comments{commentsEndpoint="http://localhost/comment/get";stylesheetUrl="http://localhost/public/css/comment.css";postFormDataUrl="http://localhost/comment/new";deleteCommentUrl="http://localhost/comment/delete/";async fetchComments(e){const t=await fetch(this.commentsEndpoint,{method:"POST",headers:{Accept:"application/json","Content-Type":"application/json"},body:JSON.stringify({postId:e})});return await t.json()}getError(e){if(0===document.getElementsByClassName("error").length){let t=document.createElement("div");t.innerText=e.message,t.classList="error",document.getElementById("root").insertAdjacentElement("beforebegin",t)}}generateID(e=8){let t="",n="ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz",o=n.length;for(let a=0;a<e;a++)t+=n.charAt(Math.floor(Math.random()*o));return t}deleteButtons(e,t){for(let n=0;n<e.length;n++){let o=e[n],a=o.dataset.commentId;o.addEventListener("click",(e=>{e.preventDefault(),this.postDeleteAction(a).then((e=>e.error?this.getError(e):this.reloadComments(t)))}))}}async postDeleteAction(e){let t={commentId:e};const n=await fetch(`${this.deleteCommentUrl+e}`,{method:"POST",headers:{Accept:"application/json","Content-Type":"application/json"},body:JSON.stringify(t)});return await n.json()}drawComments(e,t){let n=document.createElement("ul");document.getElementById("root").appendChild(n);let o=document.createElement("h1");o.classList="big-title comment-title",o.innerText="Comments",n.parentNode.insertBefore(o,n);let a=Object.values(e),m=Object.keys(e);for(let e=0;e<m.length;e++){let t=a[e],o=document.createElement("li");o.id=this.generateID(),o.classList="comment",o.innerHTML=`<div><button class="delete-comment" data-comment-id=${t.comment_id}><img src="http://localhost/public/img/delete_icon.svg" alt=""></button><span>${t.created_comment}</span><br>Username: <span>${t.username}</span><br>Full Name: ${t.first_name+" "+t.last_name}<br><br><p>${t.comment_Content}</p></div>`,n.appendChild(o)}let s=document.getElementsByClassName("delete-comment");this.deleteButtons(s,t)}callStyles(){let e=document.createElement("link"),t=document.getElementById("root");e.id=this.generateID(12),e.rel="stylesheet",e.href=this.stylesheetUrl,t.appendChild(e)}reloadComments(e){let t=document.querySelector("ul"),n=document.querySelector(".comment-title");t.remove(),n.remove(),this.fetchComments(e).then((t=>t.error?this.getError(t):this.drawComments(t,e)))}createForm(e){let t=document.createElement("form"),n=document.getElementById("root");t.innerHTML=`<h1 class="big-title">${e.title}</h1><textarea name="${e.textarea.name}" placeholder="${e.textarea.placeholder}"></textarea><button type="button" class="form-btn" id="submit-form">${e.btnText}</button>`,n.appendChild(t);document.getElementById("submit-form").addEventListener("click",(n=>{n.preventDefault();let o=new FormData(t).get(e.textarea.name).trim();this.postFormData({submitUrl:this.postFormDataUrl,newCommentData:o}).then((t=>{t.error&&this.getError(t),t.success&&(console.log(t.message),this.reloadComments(e.postId))}))})),t.onsubmit=e=>e.preventDefault()}async postFormData(e){let t={newComment:1,data:e.newCommentData};const n=await fetch(e.submitUrl,{method:"POST",headers:{Accept:"application/json","Content-Type":"application/json"},body:JSON.stringify(t)});return await n.json()}}

    /**
     *
     * @type {Comments}
     */
    let comments = new Comments();

    /**
     * Fetch Comments
     * For the first time
     */
    comments.fetchComments(<?=$postID?>)
        .then(json => json.error ? comments.getError(json) : comments.drawComments(json, <?=$postID?>));

    /**
     * Call
     * Style
     */
    comments.callStyles();

    /**
     * Create New
     * Comment Form
     */
    comments.createForm({
        postId: <?=$postID?>,
        title: "Add Comment",
        btnText: "Create Comment",
        textarea: {
            placeholder: "What do you thinking?",
            name: "new_comment"
        }
    });

</script>