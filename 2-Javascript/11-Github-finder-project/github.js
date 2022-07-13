class Github{
    constructor(){
        this.client_id = '95f47372e421b2da3414';
        this.client_secret = '0223fd9421b6e1478fcae17c9b4cef4a4680748b';
        this.repo_count_prepage = '5';
        this.repos_sort = 'created :asc';
    }
    async getUser (user){
        const profileRsponse = await fetch(`https://api.github.com/users/${user}?client_id=${this.client_id}&client_secret=${this.client_secret}`);
        const profile = await profileRsponse.json();

        const repoResponse = await fetch (`https://api.github.com/users/${user}/repos?per_page=${this.repo_count_perpage}&sort=${this.repos_sort}&client_id=${this.client_id}client_secret=${this.client_secret}`)
        const repos = await repoResponse.json();

        return{
            profile,
            repos
        }
    }
}