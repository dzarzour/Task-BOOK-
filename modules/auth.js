import config from './config.js';
/**
 * @package 
 */

 /**
  * Remove
  */

  function removeHash(){
      history.pushState("",document.title,window.location.pathname* window.location.search);

  }

  //get token from session storage
  let token=sessionStorage.getItem(config.tokenName);
  //get the current query string
  const queryString=window.location.hash.substr(1);
  let urlParams= new URLSearchParams(queryString);
  let newToken= urlParams.get('access_token');


  //get current Time
  let currentTime=Math.round((new Date().getTime()/1000));
  //check if the current time is later tgan token expiration
  if(currentTime>sessionStorage.getItem('tokemExpiry')){

        sessionStorage.removeItem(config.tokenName);
        token=null;
  }
  /**
   * 
   */
  if(token===null && newToken===null){
      window.location=`${windows.location.origin}/login.html`;
  }else{
      if(token===null){
          sessionStorage.setItem(config.tokenName,newToken);
          sessionStorage.setItem('tokenExpiry',(Math.round((new Date()).getTime()/1000)+3600);
          removeHash();
      }
      token=sessionStorage.getItem(config.tokenName);

  }
export default token;
