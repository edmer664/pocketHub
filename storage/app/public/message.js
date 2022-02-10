// function displayConversation(res) {
//     

//     if(res.last_user.avatar_path == null){
//         image = `<img class="rounded-circle img-fluid m-3" width="60" height="60"
//         src="https://avatars.dicebear.com/api/initials/{{substr(Auth::user()->first_name, 0, 1) . substr(Auth::user()->last_name, 0, 1)}}.svg?backgroundColorLevel=300&fontSize=35"
//         alt="">`
//     }else{
//         image = `<img class="rounded-circle img-fluid" width="60" height="60"
//             src="{{ url('storage/avatars/' . Auth::user()->avatar_path) }}" alt="">
//         `}

//     container.innerHTML = `
//     <div class="card border-0 py-4 ">
//                 <div class=" border-bottom border-dark ">
//                     <div class="d-flex">
//                         <div class="pr-2">
//                         ${image}
//                         </div>
//                         <div class="pb-2">
//                             <span>res</span>
//                             <p> Hi, I'm Fine Thank you <small class="pl-5">3 mins</small></p>
//                         </div>
//                     </div>
//                 </div>
//             </div>
//         `;
// }
const changeMessages = (id,user_id) => {
    // get user avatar 
    let user_avatar = '';
    if(user.avatar_path == null){
        user_avatar = `https://avatars.dicebear.com/api/initials/${user.first_name.charAt(0)}${user.last_name.charAt(0)}.svg?backgroundColorLevel=300&fontSize=35`
    }else{
        user_avatar = `/storage/avatars/${user.avatar_path}`;
    }

    // fetch user details
    let avatar_rec = "";
    fetch("/api/user/" + user_id).then(res => res.json()).then(res => {
        // display user details
        document.getElementById("user-name").innerHTML = res.user.first_name + " " + res.user.last_name;
        avatar_rec = `https://avatars.dicebear.com/api/initials/${res.user.first_name.charAt(0)}${res.user.last_name.charAt(0)}.svg?backgroundColorLevel=300&fontSize=35`;
        if(res.user.avatar_path == null){
            document.getElementById("user-image").src = `https://avatars.dicebear.com/api/initials/${res.user.first_name.charAt(0)}${res.user.last_name.charAt(0)}.svg?backgroundColorLevel=300&fontSize=35`;
            document.getElementById("user-image").srcset = `https://avatars.dicebear.com/api/initials/${res.user.first_name.charAt(0)}${res.user.last_name.charAt(0)}.svg?backgroundColorLevel=300&fontSize=35`;
        }else{
            document.getElementById("user-image").src = "/storage/avatars/" + res.user.avatar_path;
            document.getElementById("user-image").srcset = "/storage/avatars/" + res.user.avatar_path;
            avatar_rec = "/storage/avatars/" + res.user.avatar_path;
        }
    })
    // fetch messages from the conversation
    fetch("/api/conversations/" + id + "/messages").then(
        res => res.json()
    ).then(
        res => {
            let mes = document.getElementById("message-container");
            mes.innerHTML = "";
            document.getElementById("message_form").action = "/api/conversations/" + id + "/send";
            res.map(message =>{

                // if message sender id is equal to current user id then display message in right side
                if(message.sender_id === user.id){
                mes.innerHTML +=
                        `<div class="d-flex justify-content-end mb-4">
                            <p class="p-2 my-1 mx-2 rounded bg-warning text-white">
                                ${message.body}
                            </p>
                            <div class="img_cont_msg ">
                                <img src="${user_avatar}"
                                height="50px" width="50px" class="rounded-circle">
                            </div>
                        </div>`;
                }else{
                    mes.innerHTML +=
                        `<div class="d-flex justify-content-start mb-4">
                            <div class="img_cont_msg">
                                <img src="${avatar_rec}"
                                height="50px" width="50px" class="rounded-circle">
                            </div>
                            <p class="p-2 my-1 mx-2 rounded bg-light text-dark">
                                ${message.body}
                            </p>
                        </div>`;

                }
            }
            
            );
        }
    )
};

let container = document.getElementById('conv-container');
window.onload = () => {
    console.log(user);
    // fetch conversations from api
    fetch("/api/conversations/" + user.id)
        .then(res => res.json())
        .then(res => res.map(function(conversation) {
        
            if(conversation.user.avatar_path == null){
                image = `<img class="rounded-circle img-fluid m-3" width="60" height="60"
                src="https://avatars.dicebear.com/api/initials/${conversation.user.first_name.charAt(0)}${conversation.user.last_name.charAt(0)}.svg?backgroundColorLevel=300&fontSize=35"
                alt="">`
            }else{
                image = `<img class="rounded-circle img-fluid" width="60" height="60"
                    src="/storage/avatars/${conversation.user.avatar_path}" alt="">
                `}
        
            container.innerHTML += `
                    <div class="card border-0 py-4 ">
                        <button onclick="changeMessages(${conversation.id},${conversation.user.id})">
                            <div class=" border-bottom border-dark ">
                                <div class="d-flex">
                                    <div class="pr-2">
                                    ${image}
                                    </div>
                                    <div class="pb-2">
                                        <span>${conversation.user.first_name} ${conversation.user.last_name}</span>
                                        <p> ${conversation.lastMessage.body} <small class="pl-5">3 min</small></p>
                                    </div>
                                </div>
                            </div>
                        </button>
                    </div>`;
            
            
        }));
    
};
