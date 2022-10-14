export default function ({ $axios, app }) {
    
    const api = $axios.create({
        headers: {
            common:{
                Accept: 'application/json'
            }
        }
    });
    api.onRequest((config) => {console.log(app.$auth);
        if(app.$auth.loggedIn){
            const token = app.$auth.strategy.token.get().split(' ')[1];
            api.setToken(token,'Bearer')
        }
    })
}