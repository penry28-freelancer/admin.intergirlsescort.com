import Resource from '@/http/api/resource';
import request from '@/http/request';

export default class EscostReportResource extends Resource {
  constructor() {
    super('/report/escost-report');
  }

  toggleVerify(id) {
    return request({
      url: `${this.uri}/${id}/toggle-verify`,
      method: 'PATCH',
    });
  }
}
