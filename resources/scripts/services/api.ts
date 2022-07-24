import axios, { AxiosInstance } from "axios";

const apiClient: AxiosInstance = axios.create({
  /* baseURL: "http://localhost:8080/api", */
  baseURL: "/api",
  headers: {
    'Accept-Language': `es`,
    'Accept': `application/json`,
    'Content-type': `application/json`,
    'Authorization': `Bearer ${localStorage.getItem('token')}`,
  },
});

export default apiClient;
