const githubDom = new Github();
const uiDom = new UI();

const searchUser = document.getElementById ('searchUser');

searchUser.addEventListener('keyup',event=>{
    event.preventDefault();
    const inputValue = event.target.value;
    if (inputValue !== '') {
        githubDom.getUser(inputValue)
        .then(response=>{
            console.log(response,"response");
            if(response){
                const {profile , repos} = response;
                uiDom.showProfile(profile);
                uiDom.showRepos(repos);
            }else{
                uiDom.clearProfile();
            }
        })
        .catch(error=> {
            uiDom.clearProfile();
            console.log(error)
        });
    }else{
        uiDom.clearProfile();
    }
})