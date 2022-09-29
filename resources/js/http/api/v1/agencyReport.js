import Resource from '@/http/api/resource';
import request from '@/http/request';

export default class AgencyReportResource extends Resource {
  constructor() {
    super('/report/agency-report');
  }

  toggleVerify(id) {
    return request({
      url: `${this.uri}/${id}/toggle-verify`,
      method: 'PATCH',
    });
  }
}
