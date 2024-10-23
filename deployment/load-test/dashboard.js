import http from 'k6/http';
import { check } from 'k6';

export let options = {
  vus: 100, // Number of virtual users
  duration: '60s', // Test duration
};

const API_URL = 'https://backend.your-domain.com/api/v1/dashboard/bookings';
const BEARER_TOKEN = '16|87dQSP4IsYmdm0jcWWksO6kB1eOkSm7N6AUheAKM91d5dccc';

export default function () {
  const params = {
    headers: {
      'Authorization': `Bearer ${BEARER_TOKEN}`,
    },
  };

  const response = http.get(`${API_URL}?current_page=1&per_page=100&search=&status=BOOKED`, params);


  if(response.status != 500) {
	    console.log("HTTP Status: " + response.status);
  }

  check(response, {
    'status is 200': (r) => r.status === 200,
    'response body is not empty': (r) => r.body.length > 0,
  });
}
