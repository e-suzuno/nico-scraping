import axios from 'axios'

const baseDomain = "http://192.168.99.100";
const baseURL = `${baseDomain}/api`;


const defaultOptions = {
    headers: {
        'Content-Type': 'application/json',
    },
};
const instance = axios.create({
    baseURL,
    defaultOptions
});


instance.interceptors.request.use(function (config) {
    return config;
});

export default instance;
