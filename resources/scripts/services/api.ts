import axios, { AxiosInstance } from "axios";

/* const userStore = useUserStore(); */
/* const baseURL = "http://localhost:8080/api"; */

const baseURL = "/api";
const getToken = () => localStorage.getItem('token');
const getAuthorizationHeader = () => `Bearer ${getToken()}`;

const apiClient: AxiosInstance = axios.create({
  /* baseURL: "http://localhost:8080/api", */
  baseURL: baseURL,
  headers: {
    'Accept-Language': `es`,
    'Accept': `application/json`,
    'Content-type': `application/json`,
    'Authorization': getAuthorizationHeader(),
  },
});

export default apiClient;
