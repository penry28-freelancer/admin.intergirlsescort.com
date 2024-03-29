import Resource from '@/http/api/resource';
import request from '@/http/request';

export default class ClubBannerResource extends Resource {
  constructor() {
    super('/appearance/club-banner');
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
