<div class="row">
    <div class="col-lg-12 col-md-12">		
        <?php
        echo create_breadcrumb();
        echo $this->session->flashdata('notify');
        ?>
    </div>
</div><!-- /.row -->

<section class="panel panel-default">
    <header class="panel-heading">
        <div class="row">
            <div class="col-md-8 col-xs-3">                
                <?php
                echo anchor(
                        site_url('tabel_penjualan/add'), '<i class="glyphicon glyphicon-plus"></i>', 'class="btn btn-success btn-sm" data-tooltip="tooltip" data-placement="top" title="Tambah Data"'
                );
                ?>

            </div>
            <div class="col-md-4 col-xs-9">

                <?php echo form_open(site_url('tabel_penjualan/search'), 'role="search" class="form"'); ?>       
                <div class="input-group pull-right">                      
                    <input type="text" class="form-control input-sm" placeholder="Cari data" name="q" autocomplete="off"> 
                    <span class="input-group-btn">
                        <button class="btn btn-primary btn-sm" type="submit"><i class="glyphicon glyphicon-search"></i> Cari</button>
                    </span>
                </div>

                </form> 
                <?php echo form_close(); ?>
            </div>
        </div>
    </header>


    <div class="panel-body">
        <?php if ($tabel_penjualan) : ?>
            <table class="table table-hover table-condensed">

                <thead>
                    <tr>
                        <th class="header">#</th>

                        <th>No Invoice</th>   
                        <th>No Surat Peminjaman</th>
                        <th>Tgl Penjualan</th>   

                        <th>Nama User</th>   

                        <th>Total Penjualan</th>   

                        <th class="red header" align="right" width="120">Aksi</th>
                    </tr>
                </thead>


                <tbody>

                    <?php foreach ($tabel_penjualan as $penjualan) : ?>
                        <tr>
                            <td><?php
                                echo $number++;
                                ;
                                ?> </td>

                            <td><?php echo $penjualan['kode_surat']; ?></td>

                            <td><?= $penjualan['no_surat_peminjaman']?></td>
                            <td><?php echo date_format(date_create($penjualan['tgl_penjualan']),'d M Y'); ?></td>

                            <td><?php echo $penjualan['id_user']; ?></td>

                            <td><?php echo 'Rp. '.number_format($penjualan['total_penjualan'],0,',','.'); ?></td>

                            <td>    
                                <!--
                                <?php
                                echo anchor(
                                        site_url('tabel_penjualan/show/' . $penjualan['no_faktur_penjualan']), '<i class="glyphicon glyphicon-eye-open"></i>', 'class="btn btn-sm btn-info" data-tooltip="tooltip" data-placement="top" title="Detail"'
                                );
                                ?>
                                -->


                                <a id="cariBarang" class="lihat" data-target="#myLihat"  kode="<?= $penjualan['no_faktur_penjualan'] ?>"
                                   data-toggle="modal" data-backdrop="static" 
                                   ><div class="btn btn-sm btn-success"><i class="glyphicon glyphicon-book"></i></div>
                                </a>
                                <?php
                                echo anchor(
                                        site_url('tabel_penjualan/destroy/' . $penjualan['no_faktur_penjualan']), '<i class="glyphicon glyphicon-trash"></i>', 'onclick="return confirm(\'Anda yakin..???\');" class="btn btn-sm btn-danger" data-tooltip="tooltip" data-placement="top" title="Hapus"'
                                );
                                ?>   
                            </td>
                        </tr>     
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <?php echo notify('Data tabel_penjualan belum tersedia', 'info'); ?>
        <?php endif; ?>
    </div>


    <div class="panel-footer">
        <div class="row">
            <div class="col-md-3">
                Tabel Penjualan
                <span class="label label-info">
                    <?php echo $total; ?>
                </span>
            </div>  
            <div class="col-md-9">
                <?php echo $pagination; ?>
            </div>
        </div>
    </div>
</section>
<script>

    $(".lihat").on("click", function () {
        var id = $(this).attr("kode");
        
        $.ajax({
            type: "POST",
            url: "<?php echo base_url() . 'tabel_penjualan/lihat'; ?>",
            data: "id=" + id,
            success: function (resp) {
                $("#lihat").html(resp);
            }
        });
    });
</script>
<!--Modal area start                -->
<div class="modal fade" id="myLihat" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="width: 80%;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Lihat & Cetak Nota</h4>
            </div>
            <div class="modal-body"> 
                <div id="lihat"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
<!--Modal area end-->
