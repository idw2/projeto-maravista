delete from login where login not in('admin', 'internet');
delete from login_rel_pessoa where codlogin not in('71F8F8E9B09606EE49C65E9CC20F5927','202CB962AC59075B964B07152D234B70');
delete from pessoa where codpessoa not in('B4EC91ED6E6C92AC52099D19C0B1A40E','2995E89FB4A77E4FB5F56D4991C75850');


delete from guest;
delete from reservas;
delete from reservas_rel_datas;
delete from reservas_rel_datas_pacotes;
delete from reservas_rel_guest;
delete from reservas_rel_pacotes;
delete from reservas_rel_pessoa;
delete from reservas_rel_quartos;
delete from reservas_rel_tipo_quarto;
delete from reservas_rel_valor;
delete from valor;