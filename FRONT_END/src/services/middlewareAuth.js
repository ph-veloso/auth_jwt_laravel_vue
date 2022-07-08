import Cookie from 'js-cookie';

export default {
    auth(to, from, next) {
        const token = Cookie.get('_pontotel_token');
        
        if(!token || token.length < 12) {
            next('/login');
        }

        next();
    },
}