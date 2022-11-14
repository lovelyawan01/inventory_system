import Token from './Token'
import AppStorage from './AppStorage'


class User{

 responseAfterLogin(res){
   const access_token = res.data.access_token
   const username = res.data.name

   if (Token.isValid(access_token)) {
   	AppStorage.store(access_token,username)
   }
 }

 HasToken(){
 	const storeToken =  localStorage.getItem('token');
 	if (storeToken) {
 		return Token.isValid(storeToken)? true : false
 	}

 	false
 }

 logedIn(){
 	return this.HasToken()
 }

 name(){
 	if (this.logedIn()) {
 		return localStorage.getItem('user');
 	}
 }


 id(){
 	if (this.logedIn()) {
 		const payload = Token.payload(localStorage.getItem('token'));
 		return payload.sub
 	}
 	return false
 }


}
export default User = new User();