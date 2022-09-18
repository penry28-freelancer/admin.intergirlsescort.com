import Resource from '@/http/api/resource';
import request from '@/http/request';

export default class ClientReportResource extends Resource {
  constructor() {
    super('/report/client-report');
  }

  toggleVerify(id) {
    return request({
      url: `${this.uri}/${id}/toggle-verify`,
      method: 'PATCH',
    });
  }
}
