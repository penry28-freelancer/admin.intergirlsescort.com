<template>
  <div class="page-target">
    <table-panel>
      <template slot="title">
        <small class="text--uppercase">{{ $t('table.title.country_group') }}</small>
      </template>

      <template slot="buttons">
        <el-button class="btn-refresh" :class="{ 'refreshing': isRefresh }" size="mini" @click="onRefresh">
          <svg-icon icon-class="refresh" />
        </el-button>
      </template>

      <template slot="filters">
        <div class="search-table">
          <el-form @submit.native.prevent="onSearch">
            <el-input
              v-model="table.listQuery.search"
              placeholder="Type something"
              prefix-icon="el-icon-search"
            />
          </el-form>
        </div>
      </template>

      <template slot="table">
        <el-table
          v-loading="table.loading"
          :data="table.list"
          :default-sort="{ prop: table.listQuery.orderBy, order: table.listQuery.ascending }"
          border
          fit
          highlight-current-row
          @sort-change="sortChange"
        >
          <el-table-column type="expand">
            <template slot-scope="{ row }">
              <div class="table-expand">
                <div class="table-expand__inner">
                  <el-tabs v-model="activeName" type="card">
                    <el-tab-pane label="Detail" name="detail">
                      <div class="inner">
                        <div class="item">
                          <div class="label">{{ $t('table.common.created_at') }}</div>
                          <div class="value d-flex align-center">
                            <svg-icon icon-class="date" />
                            <div class="value">{{ row.created_at | parseTime('{y}/{m}/{d}') }}</div>
                          </div>
                        </div>
                        <div class="item">
                          <div class="label">{{ $t('table.common.updated_at') }}</div>
                          <div class="value d-flex align-center">
                            <svg-icon icon-class="date" />
                            <span>{{ row.updated_at | parseTime('{y}/{m}/{d}') }}</span>
                          </div>
                        </div>
                      </div>
                    </el-tab-pane>
                  </el-tabs>
                </div>
              </div>
            </template>
          </el-table-column>

          <el-table-column align="center" header-align="center" :label="$t('table.common.cardinal_number')" type="index" width="50" />

          <el-table-column :label="$t('table.common.name')" prop="name" sortable="custom" width="350">
            <template slot-scope="{ row }">
              <div class="heading">
                <span>{{ row.name }}</span>
              </div>
            </template>
          </el-table-column>

          <el-table-column :label="$t('table.common.countries')">
            <template slot-scope="{ row }">
              <div class="heading">{{ row.countries_count }}</div>
            </template>
          </el-table-column>
        </el-table>
      </template>

      <template slot="pagination">
        <pagination
          v-if="table.total > 0"
          :total="table.total"
          :page.sync="table.listQuery.page"
          :limit.sync="table.listQuery.limit"
          @pagination="getList"
        />
      </template>
    </table-panel>
  </div>
</template>

<script>
import TablePanel from '@/components/TablePanel';
import { CONST_PAGINATION } from '@/config/constants';
import Pagination from '@/components/Pagination';
import CountryGroupResource from '@/http/api/v1/countryGroup';
const countryGroupResource = new CountryGroupResource();

export default {
  name: 'CountryGroupIndex',
  components: {
    TablePanel,
    Pagination,
  },
  layout: 'admin',
  middleware: 'auth',
  data: () => ({
    activeName: 'detail',
    table: {
      listQuery: {
        limit: CONST_PAGINATION.limit,
        page: 1,
        search: '',
        orderBy: 'updated_at',
        ascending: 'descending',
      },
      list: null,
      total: 2,
      loading: false,
    },
    dialogVisible: false,
    isRefresh: false,
    targetId: null,
  }),
  created() {
    this.getList();
  },
  methods: {
    async getList() {
      try {
        this.table.loading = true;
        const { data } = await countryGroupResource.list(this.table.listQuery);
        this.table.list = data.data;
        this.table.total = data.count;
        this.isRefresh = false;
        this.table.loading = false;
      } catch (e) {
        this.isRefresh = false;
        this.table.loading = false;
      }
    },
    onRefresh() {
      this.isRefresh = true;
      this.dialogVisible = false;
      this.table.listQuery.page = 1;
      this.table.listQuery.search = '';
      this.getList();
    },
    onSearch() {
      this.table.listQuery.page = 1;
      this.getList();
    },
    sortChange(data) {
      const { prop, order } = data;
      this.table.listQuery.orderBy = prop;
      this.table.listQuery.ascending = order;
      this.getList();
    },
  },
};
</script>
