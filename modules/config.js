/**
 * 
 * 

 */

 const rootURL='http://restapi.local';

 const config={
     rootURL: rootURL,
     taskRoot:`${rootURL}/wp-json/wp/v2/tasks/`,
     authURI:`${rootURL}/oauth/authorize`,
     clientID:'FMiZe3Bs51ogyfw3mmK12kJ4AbqsOA1mZSEKWhyG',
     responseType:'token',
     tokenName:'TaskappToken'
 }

 export default config;