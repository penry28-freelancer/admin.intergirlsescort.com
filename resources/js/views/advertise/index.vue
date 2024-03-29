<template>
  <div class="page-target">
    <table-panel>
      <template slot="title">
        <small class="text--uppercase">{{ $t('table.title.advertise') }}</small>
      </template>

      <template slot="tools">
        <el-button type="primary" size="mini" class="text--uppercase" @click="onOpenForm">
          {{ $t('action.add', { model: $t('model.advertise') }) }}
        </el-button>
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

          <el-table-column :label="$t('table.common.banner_image')" sortable="custom" width="160">
            <template slot-scope="{ row }">
              <div class="image">
                <img width="150" height="50" :src="row.banner_image" alt="Banner">
              </div>
            </template>
          </el-table-column>

          <el-table-column :label="$t('table.common.link1')" prop="link1" sortable="custom" width="300">
            <template slot-scope="{ row }">
              <div class="heading">{{ row.link1 }}</div>
            </template>
          </el-table-column>

          <el-table-column :label="$t('table.common.link2')" prop="link2" sortable="custom" width="300">
            <template slot-scope="{ row }">
              <div class="heading">{{ row.link2 }}</div>
            </template>
          </el-table-column>

          <el-table-column :label="$t('table.common.link3')" prop="link3" sortable="custom" width="300">
            <template slot-scope="{ row }">
              <div class="heading">{{ row.link3 }}</div>
            </template>
          </el-table-column>

          <el-table-column :label="$t('table.common.order')" prop="order" sortable="custom" width="300">
            <template slot-scope="{ row }">
              <div class="heading">{{ row.order }}</div>
            </template>
          </el-table-column>

          <el-table-column align="center" header-align="center" :label="$t('table.common.action')">
            <template slot-scope="{ row }">
              <el-button-group>
                <el-button size="mini" icon="el-icon-edit" @click="onEdit(row.id)" />
                <el-button size="mini" icon="el-icon-delete" @click="onDestroy(row.id)" />
              </el-button-group>
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

    <form-advertise
      v-if="dialogVisible"
      :is-opened="dialogVisible"
      :target-id="targetId"
      @close="dialogVisible = false"
      @open="dialogVisible = true"
      @success="onRefresh"
    />
  </div>
</template>

<script>
import TablePanel from '@/components/TablePanel';
import { CONST_PAGINATION } from '@/config/constants';
import Pagination from '@/components/Pagination';
import FormAdvertise from './components/Form';
import AdvertiseResource from '@/http/api/v1/advertise';
const advertiseResource = new AdvertiseResource();

export default {
  name: 'AdvertiseIndex',
  components: {
    TablePanel,
    Pagination,
    FormAdvertise,
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
  watch: {
    '$route.query.edit': function (id) {
      if (id && !isNaN(id)) {
        this.onOpenForm(+id);
      }
    },
  },
  created() {
    this.getList();
    if (this.$route.query && this.$route.query.edit) {
      this.onOpenForm(+this.$route.query.edit);
    }
  },
  methods: {
    async getList() {
      try {
        this.table.loading = true;
        const { data } = await advertiseResource.list(this.table.listQuery);
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
    onOpenForm(id = null) {
      if (id) {
        this.targetId = +id;
      }
      this.dialogVisible = true;
    },
    sortChange(data) {
      const { prop, order } = data;
      this.table.listQuery.orderBy = prop;
      this.table.listQuery.ascending = order;
      this.getList();
    },
    onEdit(id) {
      this.$router.replace({
        query: {
          edit: id,
        },
      });
    },
    onDestroy(id) {
      this.$confirm(this.$t('confirms.permanently_delete.singular', {
        model: (this.$t('model.advertise')).toLowerCase(),
      }), {
        confirmButtonText: 'OK',
        cancelButtonText: 'Cancel',
        type: 'warning',
      }).then(async () => {
        try {
          this.table.loading = true;
          console.log(id);
          await advertiseResource.destroy(id);
          const idxRecord = this.table.list.findIndex(item => item.id === id);
          this.table.list.splice(idxRecord, 1);
          this.$message({
            showClose: true,
            message: this.$t('messages.permanently_deleted.singular', {
              model: (this.$t('model.advertise')).toLowerCase(),
            }),
            type: 'success',
          });
          this.table.loading = false;
        } catch (_) {
          this.table.loading = false;
        }
      }).catch(_ => {});
    },
  },
};
</script>
