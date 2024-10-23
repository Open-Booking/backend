import http from 'k6/http';
import { check } from 'k6';

export let options = {
  vus: 100, // Number of virtual users
  duration: '60s', // Test duration
};

const API_URL = 'https://backend.your-domain.com/api/v1/mobile/services';

export default function () {
  const params = {

  };

  const response = http.get(`${API_URL}?lang=en`, params);


  if(response.status != 500) {
	    console.log("HTTP Status: " + response.status);
  }

  check(response, {
    'status is 200': (r) => r.status === 200,
    'response body is not empty': (r) => r.body.length > 0,
  });
}
