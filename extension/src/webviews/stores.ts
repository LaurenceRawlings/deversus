/* eslint-disable @typescript-eslint/naming-convention */
import { readable, writable } from 'svelte/store';
import Echo from 'laravel-echo';
import Pusher from 'pusher-js';
import axios from 'axios';

axios.defaults.headers.post['Content-Type'] = 'application/x-www-form-urlencoded';

const _api = axios.create({
    baseURL: `${apiBaseUrl}/api`,
    headers: {
        // eslint-disable-next-line @typescript-eslint/naming-convention
        'Accept': 'application/json;charset=UTF-8'
    },
});
export const api = writable(_api, undefined);

export const echo = readable(new Echo({
    broadcaster: 'pusher',
    key: 'd6029712b2369adf4f1a',
    cluster: 'eu',
    forceTLS: true,
    authorizer: (channel: any, options: any) => {
        return {
            authorize: (socketId: any, callback: (_: boolean, __: any) => any) => {
                _api.post(`${apiBaseUrl}/api/broadcasting/auth`, {
                    socket_id: socketId,
                    channel_name: channel.name
                })
                    .then(response => {
                        callback(false, response.data);
                    })
                    .catch(error => {
                        callback(true, error);
                    });
            }
        };
    },
}), undefined);

