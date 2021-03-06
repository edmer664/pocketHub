const initConv = (receiver_id, sender_id) => {
    let formData = new FormData();
    formData.append("receiver_id", receiver_id);
    formData.append("sender_id", sender_id);
    const myHeaders = new Headers();
    myHeaders.append('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]')['content']);
    fetch("/api/conversations/create", {
        method: "POST",
        body: formData,
        headers: myHeaders,
    })
        .then((res) => res.json())
        .then((res) => {
            console.log(res);
            const message = document.getElementById("message_content");
            let message_form = new FormData();
            console.log(message.value);
            message_form.append("body", message.value );
            fetch(
            "/api/conversations/" + res.conversation_id + "/send",{ 
            method: "POST",
            body: message_form,
            headers: myHeaders,
        })
        console.log("Message sent to /api/conversations/" + res.conversation_id + "/send");
        // window.location.reload()  
        });
    // send message
};

const changeMessages = (id, user_id) => {
    // get user avatar
    let user_avatar = "";
    if (user.avatar_path == null) {
        user_avatar = `https://avatars.dicebear.com/api/initials/${user.first_name.charAt(
            0
        )}${user.last_name.charAt(0)}.svg?backgroundColorLevel=300&fontSize=35`;
    } else {
        user_avatar = `/storage/avatars/${user.avatar_path}`;
    }

    // fetch user details
    let avatar_rec = "";
    fetch("/api/user/" + user_id)
        .then((res) => res.json())
        .then((res) => {
            // display user details

            console.log("Running user fetch: " + "/api/user/" + user_id);

            console.log(res);
            document.getElementById("user-name").innerHTML =
                res.user.first_name + " " + res.user.last_name;
            avatar_rec = `https://avatars.dicebear.com/api/initials/${res.user.first_name.charAt(
                0
            )}${res.user.last_name.charAt(
                0
            )}.svg?backgroundColorLevel=300&fontSize=35`;
            if (res.user.avatar_path == null) {
                document.getElementById(
                    "user-image"
                ).src = `https://avatars.dicebear.com/api/initials/${res.user.first_name.charAt(
                    0
                )}${res.user.last_name.charAt(
                    0
                )}.svg?backgroundColorLevel=300&fontSize=35`;
                document.getElementById(
                    "user-image"
                ).srcset = `https://avatars.dicebear.com/api/initials/${res.user.first_name.charAt(
                    0
                )}${res.user.last_name.charAt(
                    0
                )}.svg?backgroundColorLevel=300&fontSize=35`;
            } else {
                document.getElementById("user-image").src =
                    "/storage/avatars/" + res.user.avatar_path;
                document.getElementById("user-image").srcset =
                    "/storage/avatars/" + res.user.avatar_path;
                avatar_rec = "/storage/avatars/" + res.user.avatar_path;
            }
        });
    // fetch messages from the conversation
    fetch("/api/conversations/" + id + "/messages")
        .then((res) => res.json())
        .then((res) => {
            res.reverse();
            let mes = document.getElementById("message-container");
            mes.innerHTML = "";
            document.getElementById("message_form").action =
                "/api/conversations/" + id + "/send";
            res.map((message) => {
                // if message sender id is equal to current user id then display message in right side
                if (message.sender_id === user.id) {
                    mes.innerHTML += 
                    `<div class="d-flex justify-content-end mb-4">
                            <p class="p-2 my-1 mx-2 rounded bg-danger text-white">
                                ${message.body}
                            </p>
                            <div class="img_cont_msg ">
                                <img src="${user_avatar}"
                                height="50px" width="50px" class="rounded-circle">
                            </div>
                    </div>`;
                } else {
                    mes.innerHTML += `<div class="d-flex justify-content-start mb-4">
                            <div class="img_cont_msg">
                                <img src="${avatar_rec}"
                                height="50px" width="50px" class="rounded-circle">
                            </div>
                            <p class="p-2 my-1 mx-2 rounded bg-light text-dark">
                                ${message.body}
                            </p>
                        </div>`;
                }
            });
        });
};

let container = document.getElementById("conv-container");
window.onload = () => {
    console.log("/api/conversations/" + user.id);
    // fetch conversations from api
    fetch("/api/conversations/" + user.id)
        .then((res) => res.json())
        .then(function (res) {
            console.log(res);
            res.map(function (conversation) {
                if (conversation.user.avatar_path == null) {
                    image = `<img class="rounded-circle img-fluid m-3" width="60" height="60"
                src="https://avatars.dicebear.com/api/initials/${conversation.user.first_name.charAt(
                    0
                )}${conversation.user.last_name.charAt(
                        0
                    )}.svg?backgroundColorLevel=300&fontSize=35"
                alt="">`;
                } else {
                    image = `<img class="rounded-circle img-fluid m-3" width="60" height="60"
                    src="/storage/avatars/${conversation.user.avatar_path}" alt="">
                `;
                }
                const username = `${conversation.user.first_name} ${conversation.user.last_name}`;
                container.innerHTML += `
                <a href="#" onclick="changeMessages(${conversation.id},${conversation.user.id})" class=" text-decoration-none">
                    <div class=" card  border-0  ">
                        <div class="row align-items-center border-bottom border-dark " >
                            <div class="col-auto" >
                                ${image}
                            </div>
                            <div class="col">
                                <div class="row">
                                    <span class="text-muted ">${username.substring(0,20)}</span>
                                </div>
                                <div class="row">
                                    <div class="col text-muted"> ${conversation.lastMessage.body.substring(0,12)}</div>
                                    <div class="col-auto align-self-end text-muted"> <small >${conversation.time} </small></div>
                                </div>
                            </div>
                        </div>
                    </div>    
                </a>`;
            });
        });
};
window.addEventListener("DOMContentLoaded", () => {
    console.log("DOM loaded");

    fetch("/api/conversations/" + user.id)
        .then((res) => res.json())
        .then(function (res) {
            changeMessages(res[0].id, res[0].user.id);
        });
});

const startConversation = (receiver_id, sender_id) => {
    let isNull = false;
    // paki initi
    fetch("/api/conversations/check/" + receiver_id)
        .then((res) => {
            console.log(receiver_id);
            return res.clone().json();
            
        })
        .then((res) => {
            
            console.log(res);
            if (res.is_found === false) {
                isNull = true;
            }
            if (isNull) {
                console.log("conversation is null");
                document.getElementById("message-container").innerHTML =
                    "<h1>No conversation</h1>";
                const btn = document.getElementById("send-btn");
                btn.onclick = async() => {
                    await initConv(receiver_id, sender_id);

                    setTimeout(() => {
                        window.location.reload()
                    }, 1000); 
                };
                btn.type = "button";
                document.getElementById("message_form").action = "";

                // fetch user
                let user_avatar="";
                fetch("/api/user/" + receiver_id)
                    .then((res) => res.json())
                    .then((res) => {
                        console.log(res);
                        if (res.user.avatar_path == null) {
                        user_avatar = `https://avatars.dicebear.com/api/initials/
                            ${res.user.first_name.charAt(
                                0
                            )}${res.user.last_name.charAt(
                                0
                            )}.svg?backgroundColorLevel=300&fontSize=35`;
                        } else {
                            user_avatar = `/storage/avatars/${res.user.avatar_path}`;
                        }
                        document.getElementById("user-image").src = user_avatar;
                        document.getElementById("user-image").srcset =
                            user_avatar;
                        document.getElementById("user-name").innerHTML =
                            res.user.first_name + " " + res.user.last_name;
                    });
            } else {
                console.log(res);
                if (res.sender_id == sender_id) {
                    changeMessages(res.id, res.receiver_id);
                    console.log(res.receiver_id);
                } else {
                    changeMessages(res.id, res.sender_id);
                    console.log(res.receiver_id);
                }
            }
        });
};

const searchUser = () => {
    let search_input = document.getElementById("search-bar").value;
    console.log(search_input);
    fetch("/api/users/search/" + search_input)
        .then((res) => res.json())
        .then((res) => {
            document.getElementById("conv-container").innerHTML = "";
            res.map((result) => {
                if (result.avatar_path == null) {
                    image = `<img class="rounded-circle  m-3" width="60" height="60"
                src="https://avatars.dicebear.com/api/initials/${result.first_name.charAt(
                    0
                )}${result.last_name.charAt(
                        0
                    )}.svg?backgroundColorLevel=300&fontSize=35"
                alt="">`;
                } else {
                    image = `<img class="rounded-circle " width="60" height="60"
                    src="/storage/avatars/${result.avatar_path}" alt="">
                `;
                }
                document.getElementById("conv-container").innerHTML += `
                <a href="#" onclick="startConversation(${result.id},${user.id})" class="text-decoration-none">
                    <div class=" m-1">
                        <div class="row">
                            <div class="col-auto">
                                ${image}
                            </div>
                            <div class="col align-self-center">
                                <h5 class="text-muted font-weight-bolder">${result.first_name} ${result.last_name}</h5>
                            </div>
                        </div>
                    </div>
                </a>
            `;
            });
        });
};
