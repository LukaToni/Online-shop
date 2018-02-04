/*==============================================================*/
/* DBMS name:      MySQL 5.0                                    */
/* Created on:     17. 12. 2017 15:29:57                        */
/*==============================================================*/


drop table if exists AKCIJA;

drop table if exists ARTIKEL;

drop table if exists INVENTURA;

drop table if exists KATEGORIJA;

drop table if exists KOSARICA;

drop table if exists KUPEC;

drop table if exists MNENJE;

drop table if exists NAROCILO;

drop table if exists OSEBA;

drop table if exists PLACA;

drop table if exists POSTA;

drop table if exists RACUN;

drop table if exists RELATIONSHIP_4;

drop table if exists VLOGA;

drop table if exists ZAPOSLEN;

/*==============================================================*/
/* Table: AKCIJA                                                */
/*==============================================================*/
create table AKCIJA
(
   ID_ARTIKLA           varchar(1024) not null,
   ID_AKCIJE            varchar(1024) not null,
   KOLICINA_POPUSTA     float,
   primary key (ID_ARTIKLA, ID_AKCIJE)
);

/*==============================================================*/
/* Table: ARTIKEL                                               */
/*==============================================================*/
create table ARTIKEL
(
   ID_ARTIKLA           varchar(1024) not null,
   KOLICINA             int not null,
   ID_KATEGORIJE        varchar(1024) not null,
   IME_ARTIKLA          varchar(1024),
   BARVA_ARTIKLA        varchar(1024),
   VELIKOST_ARTIKLA     char(1),
   CENA_ARTIKLA         float not null,
   primary key (ID_ARTIKLA)
);

/*==============================================================*/
/* Table: INVENTURA                                             */
/*==============================================================*/
create table INVENTURA
(
   KOLICINA             int not null,
   ID_ARTIKLA           varchar(1024) not null,
   primary key (KOLICINA)
);

/*==============================================================*/
/* Table: KATEGORIJA                                            */
/*==============================================================*/
create table KATEGORIJA
(
   ID_KATEGORIJE        varchar(1024) not null,
   IME_KATEGORIJE       varchar(1024),
   primary key (ID_KATEGORIJE)
);

/*==============================================================*/
/* Table: KOSARICA                                              */
/*==============================================================*/
create table KOSARICA
(
   ID_ARTIKLA           varchar(1024) not null,
   ID_NAROCILA          varchar(1024) not null,
   primary key (ID_ARTIKLA, ID_NAROCILA)
);

/*==============================================================*/
/* Table: KUPEC                                                 */
/*==============================================================*/
create table KUPEC
(
   ID_OSEBE             varchar(1024) not null,
   DATUM_VCLANITVE      date not null,
   POSTNA_ST            int,
   IME                  varchar(1024),
   PRIIMEK              varchar(1024),
   TEL_STEVILKA         char(9),
   ULICA                varchar(1024),
   HISNA_ST             varchar(1024),
   primary key (ID_OSEBE, DATUM_VCLANITVE)
);

/*==============================================================*/
/* Table: MNENJE                                                */
/*==============================================================*/
create table MNENJE
(
   ID_ARTIKLA           varchar(1024) not null,
   ID_OSEBE             varchar(1024) not null,
   DATUM_VCLANITVE      date not null,
   ID_MNENJA            varchar(1024) not null,
   OCENA                int,
   TEKST                varchar(1024),
   primary key (ID_ARTIKLA, ID_OSEBE, DATUM_VCLANITVE, ID_MNENJA)
);

/*==============================================================*/
/* Table: NAROCILO                                              */
/*==============================================================*/
create table NAROCILO
(
   ID_NAROCILA          varchar(1024) not null,
   RAC_ID_NAROCILA      varchar(1024),
   SIFRA_RACUNA         varchar(1024),
   ID_OSEBE             varchar(1024) not null,
   DATUM_VCLANITVE      date not null,
   primary key (ID_NAROCILA)
);

/*==============================================================*/
/* Table: OSEBA                                                 */
/*==============================================================*/
create table OSEBA
(
   ID_OSEBE             varchar(1024) not null,
   POSTNA_ST            int not null,
   IME                  varchar(1024),
   PRIIMEK              varchar(1024),
   TEL_STEVILKA         char(9),
   ULICA                varchar(1024),
   HISNA_ST             varchar(1024),
   primary key (ID_OSEBE)
);

/*==============================================================*/
/* Table: PLACA                                                 */
/*==============================================================*/
create table PLACA
(
   URNA_POSTAVKA        float not null,
   ID_OSEBE             varchar(1024) not null,
   DATUM_ZAPOSLITVE     date not null,
   DODATEK              float,
   primary key (URNA_POSTAVKA)
);

/*==============================================================*/
/* Table: POSTA                                                 */
/*==============================================================*/
create table POSTA
(
   POSTNA_ST            int not null,
   KRAJ                 varchar(1024),
   primary key (POSTNA_ST)
);

/*==============================================================*/
/* Table: RACUN                                                 */
/*==============================================================*/
create table RACUN
(
   ID_NAROCILA          varchar(1024) not null,
   SIFRA_RACUNA         varchar(1024) not null,
   SKUPNA_VSOTA         float,
   DATUM_IZDAJE         datetime,
   primary key (ID_NAROCILA, SIFRA_RACUNA)
);

/*==============================================================*/
/* Table: RELATIONSHIP_4                                        */
/*==============================================================*/
create table RELATIONSHIP_4
(
   ID_NAROCILA          varchar(1024) not null,
   KOLICINA             int not null,
   primary key (ID_NAROCILA, KOLICINA)
);

/*==============================================================*/
/* Table: VLOGA                                                 */
/*==============================================================*/
create table VLOGA
(
   ID                   varchar(1024) not null,
   IME_VLOGE            varchar(1024),
   primary key (ID)
);

/*==============================================================*/
/* Table: ZAPOSLEN                                              */
/*==============================================================*/
create table ZAPOSLEN
(
   ID_OSEBE             varchar(1024) not null,
   DATUM_ZAPOSLITVE     date not null,
   PLACA                float not null,
   VLOGA                varchar(1024) not null,
   URNA_POSTAVKA        float not null,
   ID                   varchar(1024) not null,
   POSTNA_ST            int,
   IME                  varchar(1024),
   PRIIMEK              varchar(1024),
   TEL_STEVILKA         char(9),
   ULICA                varchar(1024),
   HISNA_ST             varchar(1024),
   primary key (ID_OSEBE, DATUM_ZAPOSLITVE)
);

alter table AKCIJA add constraint FK_V_AKCIJI foreign key (ID_ARTIKLA)
      references ARTIKEL (ID_ARTIKLA) on delete restrict on update restrict;

alter table ARTIKEL add constraint FK_JE_V_KATEGORIJI foreign key (ID_KATEGORIJE)
      references KATEGORIJA (ID_KATEGORIJE) on delete restrict on update restrict;

alter table ARTIKEL add constraint FK_VSEBUJE_ARTIKEL2 foreign key (KOLICINA)
      references INVENTURA (KOLICINA) on delete restrict on update restrict;

alter table INVENTURA add constraint FK_VSEBUJE_ARTIKEL foreign key (ID_ARTIKLA)
      references ARTIKEL (ID_ARTIKLA) on delete restrict on update restrict;

alter table KOSARICA add constraint FK_KOSARICA foreign key (ID_ARTIKLA)
      references ARTIKEL (ID_ARTIKLA) on delete restrict on update restrict;

alter table KOSARICA add constraint FK_KOSARICA2 foreign key (ID_NAROCILA)
      references NAROCILO (ID_NAROCILA) on delete restrict on update restrict;

alter table KUPEC add constraint FK_PODEDUJE_PODATKE2 foreign key (ID_OSEBE)
      references OSEBA (ID_OSEBE) on delete restrict on update restrict;

alter table MNENJE add constraint FK_IMA_MNENJE_O_ARTIKLU foreign key (ID_OSEBE, DATUM_VCLANITVE)
      references KUPEC (ID_OSEBE, DATUM_VCLANITVE) on delete restrict on update restrict;

alter table MNENJE add constraint FK_IMA_OCENO foreign key (ID_ARTIKLA)
      references ARTIKEL (ID_ARTIKLA) on delete restrict on update restrict;

alter table NAROCILO add constraint FK_IMA_NAROCILO foreign key (ID_OSEBE, DATUM_VCLANITVE)
      references KUPEC (ID_OSEBE, DATUM_VCLANITVE) on delete restrict on update restrict;

alter table NAROCILO add constraint FK_IMA_RACUN foreign key (RAC_ID_NAROCILA, SIFRA_RACUNA)
      references RACUN (ID_NAROCILA, SIFRA_RACUNA) on delete restrict on update restrict;

alter table OSEBA add constraint FK_IMA_POSTO foreign key (POSTNA_ST)
      references POSTA (POSTNA_ST) on delete restrict on update restrict;

alter table PLACA add constraint FK_IMA_PLACO2 foreign key (ID_OSEBE, DATUM_ZAPOSLITVE)
      references ZAPOSLEN (ID_OSEBE, DATUM_ZAPOSLITVE) on delete restrict on update restrict;

alter table RACUN add constraint FK_IMA_RACUN2 foreign key (ID_NAROCILA)
      references NAROCILO (ID_NAROCILA) on delete restrict on update restrict;

alter table RELATIONSHIP_4 add constraint FK_RELATIONSHIP_4 foreign key (ID_NAROCILA)
      references NAROCILO (ID_NAROCILA) on delete restrict on update restrict;

alter table RELATIONSHIP_4 add constraint FK_RELATIONSHIP_5 foreign key (KOLICINA)
      references INVENTURA (KOLICINA) on delete restrict on update restrict;

alter table ZAPOSLEN add constraint FK_IMA_PLACO foreign key (URNA_POSTAVKA)
      references PLACA (URNA_POSTAVKA) on delete restrict on update restrict;

alter table ZAPOSLEN add constraint FK_IMA_VLOGO foreign key (ID)
      references VLOGA (ID) on delete restrict on update restrict;

alter table ZAPOSLEN add constraint FK_PODEDUJE_PODATKE foreign key (ID_OSEBE)
      references OSEBA (ID_OSEBE) on delete restrict on update restrict;

