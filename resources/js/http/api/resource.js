import request from '@/http/request';

class Resource {
  constructor(uri) {
    this.uri = uri;
  }

  all() {
    return request({
      url: `${this.uri}/list/all`,
      method: 'GET',
    });
  }

  list(query) {
    return request({
      url: this.uri,
      method: 'GET',
      params: query,
    });
  }

  get(id) {
    return request({
      url: `${this.uri}/${id}`,
      method: 'GET',
    });
  }

  store(resource) {
    return request({
      url: this.uri,
      method: 'POST',
      data: resource,
    });
  }

  update(resource, id) {
    return request({
      url: `${this.uri}/${id}`,
      method: 'PUT',
      data: resource,
    });
  }

  destroy(id) {
    return request({
      url: `${this.uri}/${id}`,
      method: 'delete',
    });
  }

  massDestroy(ids) {
    return request({
      url: `${this.uri}/mass-destroy`,
      method: 'post',
      data: {
        ids: ids,
      },
    });
  }
}

export { Resource as default };
