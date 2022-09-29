import Resource from '@/http/api/resource';

export default class AdvertiseResource extends Resource {
  constructor() {
    super('/utility/advertise');
  }
  store(resource) {
    return request({
      url: this.uri,
      method: 'POST',
      data: resource,
      headers: {
        'Content-type': 'multipart/form-data',
      },
    });
  }
  update(resource, id) {
    return request({
      url: `${this.uri}/${id}`,
      method: 'POST',
      params: {
        _method: 'PUT',
      },
      data: resource,
      headers: {
        'Content-type': 'multipart/form-data',
      },
    });
  }
}
