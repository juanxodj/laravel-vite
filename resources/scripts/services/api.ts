import axios, { AxiosInstance } from "axios";

const $token = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiYjNiYTVjMTVhMmRmMDYyMzE5YTUwZjEzN2FiNDgwYjBiZTdiN2ZkMzAwNTI1ZDRhNDU0OWM3M2FlOGQyMjk3MzRjZDhkNDFkMWMyZmE3ZDIiLCJpYXQiOjE2NTg0ODI1NjEuOTg4MzQzLCJuYmYiOjE2NTg0ODI1NjEuOTg4MzQ2LCJleHAiOjE2OTAwMTg1NjEuOTc5OTU0LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.BlLCx8utb9Zb8kVeX2pXd422mzQLkPM6JQ3mSdaFDjlx0NC_AHqU9Q728wTLoFn6w9ttUY2MOlZcJ7ct6l7jIBj1iiy92z8zeK3aI2MRWBHGaWWQ2dgJFFw7CiT99MW7Q9QCWTL21T5e7IpC8NB9QrsbcCoMQazhaaEdN9uUfJx9RbX5MXZcD79J__GJ8mcqfR3AzNq0M7WTlDTWo4nJppQoiJXwRyq0n66JTCDB9HJLXnLPdt8_iTh_F0lRzxef3HflV0TU2AZ2iw8vNGtvD_bep7FVV730gOR-3iGoS76Z9-xiUrc5zSmvw_rNt0ig4QFa6-FCqVtIH7g7jGk63D8nCA-AIcXjVqvdF9Z_FG6FBRmQJvEXonb5JJCgqhL942tHCtWp4Ua2cLCjncohHnTc6CGEFC6psLK2iytJFEYMATRNmvaDppk_HMyLm3YJHgf4dTrOfwU4kjOi2gsbHVovvpqjOrENf0SIVIOHwptoeS3hC9o5b_m3cpUKMgfUlD0whrBc6j8dpiglR6jNdDfAOy0XzHyXj8W80U5YsqkGGDM3R1bILbHQ8jQE6A9NIigAgtl0XUZdr3hKCNZZ0wf5zCQjQZbPkjji_GEnIDK_aXWqoC21KHP8vYAs5sM4u3MLKaEv9uO_cfe0Ny6LuAfMRukRAdnmrPlcc5JnYjk';

const apiClient: AxiosInstance = axios.create({
  /* baseURL: "http://localhost:8080/api", */
  baseURL: "/api",
  headers: {
    'Accept-Language': `es`,
    'Accept': `application/json`,
    'Content-type': `application/json`,
    /* 'Authorization': `Bearer ${localStorage.token}`, */
    'Authorization': `Bearer ${$token}`
  },
});

export default apiClient;
