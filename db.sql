PGDMP                          y            admisi    12.5    12.5 �    J           0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                      false            K           0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                      false            L           0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                      false            M           1262    16393    admisi    DATABASE     �   CREATE DATABASE admisi WITH TEMPLATE = template0 ENCODING = 'UTF8' LC_COLLATE = 'English_American Samoa.1252' LC_CTYPE = 'English_American Samoa.1252';
    DROP DATABASE admisi;
                postgres    false                        2615    16827    public    SCHEMA        CREATE SCHEMA public;
    DROP SCHEMA public;
                postgres    false            �           1247    16872    e_agama    TYPE     �   CREATE TYPE public.e_agama AS ENUM (
    'KRISTEN',
    'ISLAM',
    'KATOLIK',
    'HINDU',
    'BUDHA',
    'KONGHUCU',
    'LAINNYA'
);
    DROP TYPE public.e_agama;
       public          postgres    false    5            �           1247    16842    e_bayar    TYPE     f   CREATE TYPE public.e_bayar AS ENUM (
    'BELUM LUNAS',
    'VALIDASI',
    'LUNAS',
    'EXPIRED'
);
    DROP TYPE public.e_bayar;
       public          postgres    false    5            �           1247    17120    e_darah    TYPE     L   CREATE TYPE public.e_darah AS ENUM (
    'A',
    'B',
    'AB',
    'O'
);
    DROP TYPE public.e_darah;
       public          postgres    false    5            �           1247    16860 
   e_formulir    TYPE     J   CREATE TYPE public.e_formulir AS ENUM (
    'AKTIF',
    'TIDAK AKTIF'
);
    DROP TYPE public.e_formulir;
       public          postgres    false    5            �           1247    25180 
   e_hubungan    TYPE     \   CREATE TYPE public.e_hubungan AS ENUM (
    'AYAH',
    'IBU',
    'SAUDARA',
    'WALI'
);
    DROP TYPE public.e_hubungan;
       public          postgres    false    5            �           1247    16866 	   e_kelamin    TYPE     ;   CREATE TYPE public.e_kelamin AS ENUM (
    'P',
    'L'
);
    DROP TYPE public.e_kelamin;
       public          postgres    false    5            �           1247    16898 
   e_keuangan    TYPE     w   CREATE TYPE public.e_keuangan AS ENUM (
    'BELUM BAYAR',
    'VALIDASI KEUANGAN',
    'VALIDASI NIM',
    'LUNAS'
);
    DROP TYPE public.e_keuangan;
       public          postgres    false    5            �           1247    17130    e_kewarganegaraan    TYPE     G   CREATE TYPE public.e_kewarganegaraan AS ENUM (
    'WNI',
    'WNA'
);
 $   DROP TYPE public.e_kewarganegaraan;
       public          postgres    false    5            �           1247    16832    e_pendidikan    TYPE     V   CREATE TYPE public.e_pendidikan AS ENUM (
    'SMA',
    'SMK',
    'S1',
    'S2'
);
    DROP TYPE public.e_pendidikan;
       public          postgres    false    5            �           1247    16852    e_penerimaan    TYPE     [   CREATE TYPE public.e_penerimaan AS ENUM (
    'DITERIMA',
    'DIPROSES',
    'DITOLAK'
);
    DROP TYPE public.e_penerimaan;
       public          postgres    false    5            �           1247    16916 
   e_prestasi    TYPE     O   CREATE TYPE public.e_prestasi AS ENUM (
    'NASIONAL',
    'INTERNASIONAL'
);
    DROP TYPE public.e_prestasi;
       public          postgres    false    5            &           1247    25330    e_registrasi_ulang    TYPE        CREATE TYPE public.e_registrasi_ulang AS ENUM (
    'BELUM BAYAR',
    'VALIDASI KEUANGAN',
    'VALIDASI NIM',
    'LUNAS'
);
 %   DROP TYPE public.e_registrasi_ulang;
       public          postgres    false    5            �           1247    25305    e_role    TYPE     K   CREATE TYPE public.e_role AS ENUM (
    'ADMIN',
    'USER',
    'PPMB'
);
    DROP TYPE public.e_role;
       public          postgres    false    5            �           1247    16888    e_sipil    TYPE     `   CREATE TYPE public.e_sipil AS ENUM (
    'NIKAH',
    'BELUM NIKAH',
    'JANDA',
    'DUDA'
);
    DROP TYPE public.e_sipil;
       public          postgres    false    5            �           1247    16908    e_ukuran    TYPE     C   CREATE TYPE public.e_ukuran AS ENUM (
    'S',
    'M',
    'L'
);
    DROP TYPE public.e_ukuran;
       public          postgres    false    5            -           1247    25356    e_ukuran_jas    TYPE     \   CREATE TYPE public.e_ukuran_jas AS ENUM (
    'S',
    'M',
    'L',
    'LL',
    'LLL'
);
    DROP TYPE public.e_ukuran_jas;
       public          postgres    false    5            �            1259    16923    akun    TABLE     �  CREATE TABLE public.akun (
    id bigint NOT NULL,
    nama character varying(100) NOT NULL,
    email character varying(100) NOT NULL,
    password character varying(128) NOT NULL,
    email_verified_at timestamp without time zone,
    created_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    updated_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    no_hp character varying(15) NOT NULL,
    role public.e_role DEFAULT 'USER'::public.e_role
);
    DROP TABLE public.akun;
       public         heap    postgres    false    720    5    720            �            1259    16921    akun_id_seq    SEQUENCE     �   CREATE SEQUENCE public.akun_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 "   DROP SEQUENCE public.akun_id_seq;
       public          postgres    false    204    5            N           0    0    akun_id_seq    SEQUENCE OWNED BY     ;   ALTER SEQUENCE public.akun_id_seq OWNED BY public.akun.id;
          public          postgres    false    203            �            1259    25367 
   daftar_omb    TABLE     �   CREATE TABLE public.daftar_omb (
    id bigint NOT NULL,
    registrasi_ulang_id bigint,
    ukuran_jas_alma public.e_ukuran_jas
);
    DROP TABLE public.daftar_omb;
       public         heap    postgres    false    813    5            �            1259    25376    daftar_omb_id_seq    SEQUENCE     �   ALTER TABLE public.daftar_omb ALTER COLUMN id ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public.daftar_omb_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);
            public          postgres    false    245    5            �            1259    25215    detail_pendidikan    TABLE     �  CREATE TABLE public.detail_pendidikan (
    id bigint NOT NULL,
    sekolah_id bigint,
    status public.e_pendidikan,
    npsn character varying,
    jurusan character varying,
    tahun_masuk character varying,
    tahun_lulus character varying,
    nama_sekolah character varying,
    upload_ijazah character varying,
    upload_daftar_nilai character varying,
    pendaftaran_id bigint
);
 %   DROP TABLE public.detail_pendidikan;
       public         heap    postgres    false    5    729            �            1259    25213    detail_pendidikan_id_seq    SEQUENCE     �   ALTER TABLE public.detail_pendidikan ALTER COLUMN id ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public.detail_pendidikan_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);
            public          postgres    false    235    5            �            1259    25260    detail_prestasi    TABLE        CREATE TABLE public.detail_prestasi (
    id bigint NOT NULL,
    pendaftaran_id bigint NOT NULL,
    jenis_prestasi public.e_prestasi,
    nama_kegiatan character varying,
    tgl_kegiatan character varying,
    upload_bukti_prestasi character varying
);
 #   DROP TABLE public.detail_prestasi;
       public         heap    postgres    false    5    756            �            1259    25258    detail_prestasi_id_seq    SEQUENCE     �   ALTER TABLE public.detail_prestasi ALTER COLUMN id ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public.detail_prestasi_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);
            public          postgres    false    239    5            �            1259    25195    detail_wali    TABLE     �  CREATE TABLE public.detail_wali (
    id bigint NOT NULL,
    pendaftaran_id bigint NOT NULL,
    nama character varying(255),
    "NIK" character varying(32),
    no_hp character varying(25),
    email character varying(255),
    pendidikan_terakhir character varying(50),
    pekerjaan character varying(80),
    nama_instansi character varying(255),
    alamat_instansi character varying(255),
    telp_instansi character varying(50),
    penghasilan_perbulan character varying(255),
    nama_ibu_kandung character varying(255),
    alamat character varying(255),
    kelurahan_id bigint,
    status_hubungan public.e_hubungan,
    kewarganegaraan public.e_kewarganegaraan,
    negara character varying
);
    DROP TABLE public.detail_wali;
       public         heap    postgres    false    675    691    5            �            1259    25189    detail_wali_id_seq    SEQUENCE     �   ALTER TABLE public.detail_wali ALTER COLUMN id ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public.detail_wali_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);
            public          postgres    false    233    5            �            1259    25193    detail_wali_kelurahan_id_seq    SEQUENCE     �   CREATE SEQUENCE public.detail_wali_kelurahan_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 3   DROP SEQUENCE public.detail_wali_kelurahan_id_seq;
       public          postgres    false    233    5            O           0    0    detail_wali_kelurahan_id_seq    SEQUENCE OWNED BY     ]   ALTER SEQUENCE public.detail_wali_kelurahan_id_seq OWNED BY public.detail_wali.kelurahan_id;
          public          postgres    false    232            �            1259    25191    detail_wali_pendaftaran_id_seq    SEQUENCE     �   CREATE SEQUENCE public.detail_wali_pendaftaran_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 5   DROP SEQUENCE public.detail_wali_pendaftaran_id_seq;
       public          postgres    false    233    5            P           0    0    detail_wali_pendaftaran_id_seq    SEQUENCE OWNED BY     a   ALTER SEQUENCE public.detail_wali_pendaftaran_id_seq OWNED BY public.detail_wali.pendaftaran_id;
          public          postgres    false    231            �            1259    16964    fakultas    TABLE     �   CREATE TABLE public.fakultas (
    id integer NOT NULL,
    nama_fakultas character varying(200) NOT NULL,
    created_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    updated_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP
);
    DROP TABLE public.fakultas;
       public         heap    postgres    false    5            �            1259    16962    fakultas_id_seq    SEQUENCE     �   CREATE SEQUENCE public.fakultas_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 &   DROP SEQUENCE public.fakultas_id_seq;
       public          postgres    false    212    5            Q           0    0    fakultas_id_seq    SEQUENCE OWNED BY     C   ALTER SEQUENCE public.fakultas_id_seq OWNED BY public.fakultas.id;
          public          postgres    false    211            �            1259    25273    hasil_penerimaan    TABLE     &  CREATE TABLE public.hasil_penerimaan (
    id bigint NOT NULL,
    pendaftaran_id bigint NOT NULL,
    prodi_id bigint NOT NULL,
    kode_skpm bigint NOT NULL,
    upload_skpm character varying,
    status public.e_penerimaan,
    created_at time without time zone DEFAULT CURRENT_TIMESTAMP
);
 $   DROP TABLE public.hasil_penerimaan;
       public         heap    postgres    false    5    735            �            1259    25292    hasil_penerimaan_id_seq    SEQUENCE     �   ALTER TABLE public.hasil_penerimaan ALTER COLUMN id ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public.hasil_penerimaan_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);
            public          postgres    false    5    240            �            1259    25351    hasil_penerimaan_kode_skpm_seq    SEQUENCE     �   ALTER TABLE public.hasil_penerimaan ALTER COLUMN kode_skpm ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public.hasil_penerimaan_kode_skpm_seq
    START WITH 1000
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);
            public          postgres    false    5    240            �            1259    16934    jalur_pendaftaran    TABLE       CREATE TABLE public.jalur_pendaftaran (
    id integer NOT NULL,
    jalur_pendaftaran character varying(100) NOT NULL,
    created_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    updated_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP
);
 %   DROP TABLE public.jalur_pendaftaran;
       public         heap    postgres    false    5            �            1259    16932    jalur_pendaftaran_id_seq    SEQUENCE     �   CREATE SEQUENCE public.jalur_pendaftaran_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 /   DROP SEQUENCE public.jalur_pendaftaran_id_seq;
       public          postgres    false    5    206            R           0    0    jalur_pendaftaran_id_seq    SEQUENCE OWNED BY     U   ALTER SEQUENCE public.jalur_pendaftaran_id_seq OWNED BY public.jalur_pendaftaran.id;
          public          postgres    false    205            �            1259    17077    jenis_pembayaran_id_seq    SEQUENCE     �   CREATE SEQUENCE public.jenis_pembayaran_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    MAXVALUE 2147483647
    CACHE 1;
 .   DROP SEQUENCE public.jenis_pembayaran_id_seq;
       public          postgres    false    5            �            1259    17072    jenis_pembayaran    TABLE     �   CREATE TABLE public.jenis_pembayaran (
    id bigint DEFAULT nextval('public.jenis_pembayaran_id_seq'::regclass) NOT NULL,
    jenis_pembayaran character varying(45) NOT NULL,
    info_pembayaran character varying
);
 $   DROP TABLE public.jenis_pembayaran;
       public         heap    postgres    false    223    5            �            1259    16954    jenjang    TABLE     �   CREATE TABLE public.jenjang (
    id integer NOT NULL,
    jenjang character varying(20) NOT NULL,
    created_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    updated_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP
);
    DROP TABLE public.jenjang;
       public         heap    postgres    false    5            �            1259    16952    jenjang_id_seq    SEQUENCE     �   CREATE SEQUENCE public.jenjang_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 %   DROP SEQUENCE public.jenjang_id_seq;
       public          postgres    false    5    210            S           0    0    jenjang_id_seq    SEQUENCE OWNED BY     A   ALTER SEQUENCE public.jenjang_id_seq OWNED BY public.jenjang.id;
          public          postgres    false    209            �            1259    17002 	   kecamatan    TABLE     �   CREATE TABLE public.kecamatan (
    id bigint NOT NULL,
    kota_id bigint NOT NULL,
    kecamatan character varying(255),
    kode_pos character varying(10)
);
    DROP TABLE public.kecamatan;
       public         heap    postgres    false    5            �            1259    17139    kecamatan_id_seq    SEQUENCE     �   ALTER TABLE public.kecamatan ALTER COLUMN id ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public.kecamatan_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);
            public          postgres    false    217    5            �            1259    17007 	   kelurahan    TABLE     �   CREATE TABLE public.kelurahan (
    id bigint NOT NULL,
    kecamatan_id bigint NOT NULL,
    kelurahan character varying(255)
);
    DROP TABLE public.kelurahan;
       public         heap    postgres    false    5            �            1259    17137    kelurahan_id_seq    SEQUENCE     �   ALTER TABLE public.kelurahan ALTER COLUMN id ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public.kelurahan_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);
            public          postgres    false    5    218            �            1259    16992    kota    TABLE     {   CREATE TABLE public.kota (
    id bigint NOT NULL,
    provinsi_id bigint NOT NULL,
    kota_kab character varying(255)
);
    DROP TABLE public.kota;
       public         heap    postgres    false    5            �            1259    17154    kota_id_seq    SEQUENCE     �   ALTER TABLE public.kota ALTER COLUMN id ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public.kota_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);
            public          postgres    false    5    216            �            1259    16828 
   migrations    TABLE     @   CREATE TABLE public.migrations (
    version bigint NOT NULL
);
    DROP TABLE public.migrations;
       public         heap    postgres    false    5            �            1259    17097 
   pembayaran    TABLE     =  CREATE TABLE public.pembayaran (
    id bigint NOT NULL,
    pendaftaran_id bigint NOT NULL,
    jenis_pembayaran_id bigint NOT NULL,
    nama_camaru character varying(255),
    upload_bukti_bayar character varying(255),
    tgl_bayar timestamp without time zone,
    total_bayar bigint,
    status public.e_bayar
);
    DROP TABLE public.pembayaran;
       public         heap    postgres    false    5    732            �            1259    17095    pembayaran_id_seq    SEQUENCE     �   ALTER TABLE public.pembayaran ALTER COLUMN id ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public.pembayaran_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);
            public          postgres    false    5    225            �            1259    17059    pendaftaran_id_seq    SEQUENCE     �   CREATE SEQUENCE public.pendaftaran_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    MAXVALUE 2147483647
    CACHE 1;
 )   DROP SEQUENCE public.pendaftaran_id_seq;
       public          postgres    false    5            �            1259    17036    pendaftaran    TABLE     _  CREATE TABLE public.pendaftaran (
    id bigint DEFAULT nextval('public.pendaftaran_id_seq'::regclass) NOT NULL,
    jalur_pendaftaran_id bigint,
    tahun_akademik_id bigint,
    jenjang_id bigint,
    status_formulir public.e_formulir,
    "NISN" character varying,
    "NIK" character varying,
    nama character varying,
    email character varying,
    no_hp character varying,
    kota_kelahiran character varying,
    tgl_lahir character varying,
    jenis_kelamin public.e_kelamin,
    agama public.e_agama,
    akun_id bigint,
    created_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    pekerjaan character varying(255),
    status_sipil public.e_sipil,
    gol_darah public.e_darah,
    berat_badan double precision,
    tinggi_badan double precision,
    kewarganegaraan public.e_kewarganegaraan,
    alamat_asal character varying(400),
    prodi_1_id bigint,
    prodi_2_id bigint,
    kelurahan_id bigint,
    upload_foto character varying,
    upload_kk character varying,
    upload_akta_lahir character varying,
    upload_srt_pernyataan character varying,
    negara character varying
);
    DROP TABLE public.pendaftaran;
       public         heap    postgres    false    221    738    741    744    5    747    675    672            �            1259    25388 
   pengumuman    TABLE     �   CREATE TABLE public.pengumuman (
    id bigint NOT NULL,
    judul character varying,
    isi text,
    foto character varying,
    status character varying,
    created_at timestamp without time zone DEFAULT now()
);
    DROP TABLE public.pengumuman;
       public         heap    postgres    false    5            �            1259    25386    pengumuman_id_seq    SEQUENCE     �   ALTER TABLE public.pengumuman ALTER COLUMN id ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public.pengumuman_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);
            public          postgres    false    248    5            �            1259    16974    prodi    TABLE       CREATE TABLE public.prodi (
    id integer NOT NULL,
    fakultas_id integer NOT NULL,
    nama_prodi character varying(255) NOT NULL,
    created_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    updated_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP
);
    DROP TABLE public.prodi;
       public         heap    postgres    false    5            �            1259    16972    prodi_id_seq    SEQUENCE     �   CREATE SEQUENCE public.prodi_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 #   DROP SEQUENCE public.prodi_id_seq;
       public          postgres    false    214    5            T           0    0    prodi_id_seq    SEQUENCE OWNED BY     =   ALTER SEQUENCE public.prodi_id_seq OWNED BY public.prodi.id;
          public          postgres    false    213            �            1259    16987    provinsi    TABLE     ^   CREATE TABLE public.provinsi (
    id bigint NOT NULL,
    provinsi character varying(255)
);
    DROP TABLE public.provinsi;
       public         heap    postgres    false    5            �            1259    17135    provinsi_id_seq    SEQUENCE     �   ALTER TABLE public.provinsi ALTER COLUMN id ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public.provinsi_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);
            public          postgres    false    215    5            �            1259    25313    registrasi_ulang    TABLE     �   CREATE TABLE public.registrasi_ulang (
    id bigint NOT NULL,
    hasil_penerimaan_id bigint,
    nama_camaru character varying,
    upload_bukti_bayar character varying,
    nim bigint,
    prodi_id bigint,
    status public.e_registrasi_ulang
);
 $   DROP TABLE public.registrasi_ulang;
       public         heap    postgres    false    5    806            �            1259    25311    registrasi_ulang_id_seq    SEQUENCE     �   ALTER TABLE public.registrasi_ulang ALTER COLUMN id ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public.registrasi_ulang_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);
            public          postgres    false    243    5            �            1259    25235    sekolah    TABLE     �   CREATE TABLE public.sekolah (
    id bigint NOT NULL,
    sekolah character varying,
    alamat character varying,
    kota_id bigint NOT NULL
);
    DROP TABLE public.sekolah;
       public         heap    postgres    false    5            �            1259    25233    sekolah_id_seq    SEQUENCE     �   ALTER TABLE public.sekolah ALTER COLUMN id ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public.sekolah_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);
            public          postgres    false    237    5            �            1259    16944    tahun_akademik    TABLE     B  CREATE TABLE public.tahun_akademik (
    id bigint NOT NULL,
    tahun_akademik character varying(20) NOT NULL,
    created_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    updated_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    status character varying DEFAULT 'NONAKTIF'::character varying
);
 "   DROP TABLE public.tahun_akademik;
       public         heap    postgres    false    5            �            1259    16942    tahun_akademik_id_seq    SEQUENCE     �   CREATE SEQUENCE public.tahun_akademik_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 ,   DROP SEQUENCE public.tahun_akademik_id_seq;
       public          postgres    false    5    208            U           0    0    tahun_akademik_id_seq    SEQUENCE OWNED BY     O   ALTER SEQUENCE public.tahun_akademik_id_seq OWNED BY public.tahun_akademik.id;
          public          postgres    false    207            �            1259    17023    univ    TABLE     �   CREATE TABLE public.univ (
    id bigint NOT NULL,
    nama character varying(255) NOT NULL,
    alamat character varying(255) NOT NULL,
    kota_id bigint NOT NULL
);
    DROP TABLE public.univ;
       public         heap    postgres    false    5            A           2604    17079    akun id    DEFAULT     b   ALTER TABLE ONLY public.akun ALTER COLUMN id SET DEFAULT nextval('public.akun_id_seq'::regclass);
 6   ALTER TABLE public.akun ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    204    203    204            X           2604    25198    detail_wali pendaftaran_id    DEFAULT     �   ALTER TABLE ONLY public.detail_wali ALTER COLUMN pendaftaran_id SET DEFAULT nextval('public.detail_wali_pendaftaran_id_seq'::regclass);
 I   ALTER TABLE public.detail_wali ALTER COLUMN pendaftaran_id DROP DEFAULT;
       public          postgres    false    233    231    233            O           2604    16967    fakultas id    DEFAULT     j   ALTER TABLE ONLY public.fakultas ALTER COLUMN id SET DEFAULT nextval('public.fakultas_id_seq'::regclass);
 :   ALTER TABLE public.fakultas ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    212    211    212            E           2604    16937    jalur_pendaftaran id    DEFAULT     |   ALTER TABLE ONLY public.jalur_pendaftaran ALTER COLUMN id SET DEFAULT nextval('public.jalur_pendaftaran_id_seq'::regclass);
 C   ALTER TABLE public.jalur_pendaftaran ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    206    205    206            L           2604    16957 
   jenjang id    DEFAULT     h   ALTER TABLE ONLY public.jenjang ALTER COLUMN id SET DEFAULT nextval('public.jenjang_id_seq'::regclass);
 9   ALTER TABLE public.jenjang ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    210    209    210            R           2604    16977    prodi id    DEFAULT     d   ALTER TABLE ONLY public.prodi ALTER COLUMN id SET DEFAULT nextval('public.prodi_id_seq'::regclass);
 7   ALTER TABLE public.prodi ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    214    213    214            H           2604    25403    tahun_akademik id    DEFAULT     v   ALTER TABLE ONLY public.tahun_akademik ALTER COLUMN id SET DEFAULT nextval('public.tahun_akademik_id_seq'::regclass);
 @   ALTER TABLE public.tahun_akademik ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    207    208    208                      0    16923    akun 
   TABLE DATA           q   COPY public.akun (id, nama, email, password, email_verified_at, created_at, updated_at, no_hp, role) FROM stdin;
    public          postgres    false    204   ��       D          0    25367 
   daftar_omb 
   TABLE DATA           N   COPY public.daftar_omb (id, registrasi_ulang_id, ukuran_jas_alma) FROM stdin;
    public          postgres    false    245   /�       :          0    25215    detail_pendidikan 
   TABLE DATA           �   COPY public.detail_pendidikan (id, sekolah_id, status, npsn, jurusan, tahun_masuk, tahun_lulus, nama_sekolah, upload_ijazah, upload_daftar_nilai, pendaftaran_id) FROM stdin;
    public          postgres    false    235   ��       >          0    25260    detail_prestasi 
   TABLE DATA           �   COPY public.detail_prestasi (id, pendaftaran_id, jenis_prestasi, nama_kegiatan, tgl_kegiatan, upload_bukti_prestasi) FROM stdin;
    public          postgres    false    239   ��       8          0    25195    detail_wali 
   TABLE DATA             COPY public.detail_wali (id, pendaftaran_id, nama, "NIK", no_hp, email, pendidikan_terakhir, pekerjaan, nama_instansi, alamat_instansi, telp_instansi, penghasilan_perbulan, nama_ibu_kandung, alamat, kelurahan_id, status_hubungan, kewarganegaraan, negara) FROM stdin;
    public          postgres    false    233   @�       #          0    16964    fakultas 
   TABLE DATA           M   COPY public.fakultas (id, nama_fakultas, created_at, updated_at) FROM stdin;
    public          postgres    false    212   ��       ?          0    25273    hasil_penerimaan 
   TABLE DATA           t   COPY public.hasil_penerimaan (id, pendaftaran_id, prodi_id, kode_skpm, upload_skpm, status, created_at) FROM stdin;
    public          postgres    false    240   ;�                 0    16934    jalur_pendaftaran 
   TABLE DATA           Z   COPY public.jalur_pendaftaran (id, jalur_pendaftaran, created_at, updated_at) FROM stdin;
    public          postgres    false    206   +�       -          0    17072    jenis_pembayaran 
   TABLE DATA           Q   COPY public.jenis_pembayaran (id, jenis_pembayaran, info_pembayaran) FROM stdin;
    public          postgres    false    222   ��       !          0    16954    jenjang 
   TABLE DATA           F   COPY public.jenjang (id, jenjang, created_at, updated_at) FROM stdin;
    public          postgres    false    210   ��       (          0    17002 	   kecamatan 
   TABLE DATA           E   COPY public.kecamatan (id, kota_id, kecamatan, kode_pos) FROM stdin;
    public          postgres    false    217   Z�       )          0    17007 	   kelurahan 
   TABLE DATA           @   COPY public.kelurahan (id, kecamatan_id, kelurahan) FROM stdin;
    public          postgres    false    218   K�       '          0    16992    kota 
   TABLE DATA           9   COPY public.kota (id, provinsi_id, kota_kab) FROM stdin;
    public          postgres    false    216   H                0    16828 
   migrations 
   TABLE DATA           -   COPY public.migrations (version) FROM stdin;
    public          postgres    false    202   ~I      0          0    17097 
   pembayaran 
   TABLE DATA           �   COPY public.pembayaran (id, pendaftaran_id, jenis_pembayaran_id, nama_camaru, upload_bukti_bayar, tgl_bayar, total_bayar, status) FROM stdin;
    public          postgres    false    225   �I      +          0    17036    pendaftaran 
   TABLE DATA           �  COPY public.pendaftaran (id, jalur_pendaftaran_id, tahun_akademik_id, jenjang_id, status_formulir, "NISN", "NIK", nama, email, no_hp, kota_kelahiran, tgl_lahir, jenis_kelamin, agama, akun_id, created_at, pekerjaan, status_sipil, gol_darah, berat_badan, tinggi_badan, kewarganegaraan, alamat_asal, prodi_1_id, prodi_2_id, kelurahan_id, upload_foto, upload_kk, upload_akta_lahir, upload_srt_pernyataan, negara) FROM stdin;
    public          postgres    false    220   �M      G          0    25388 
   pengumuman 
   TABLE DATA           N   COPY public.pengumuman (id, judul, isi, foto, status, created_at) FROM stdin;
    public          postgres    false    248   �\      %          0    16974    prodi 
   TABLE DATA           T   COPY public.prodi (id, fakultas_id, nama_prodi, created_at, updated_at) FROM stdin;
    public          postgres    false    214   �_      &          0    16987    provinsi 
   TABLE DATA           0   COPY public.provinsi (id, provinsi) FROM stdin;
    public          postgres    false    215   ]`      B          0    25313    registrasi_ulang 
   TABLE DATA           {   COPY public.registrasi_ulang (id, hasil_penerimaan_id, nama_camaru, upload_bukti_bayar, nim, prodi_id, status) FROM stdin;
    public          postgres    false    243   �`      <          0    25235    sekolah 
   TABLE DATA           ?   COPY public.sekolah (id, sekolah, alamat, kota_id) FROM stdin;
    public          postgres    false    237   �b                0    16944    tahun_akademik 
   TABLE DATA           \   COPY public.tahun_akademik (id, tahun_akademik, created_at, updated_at, status) FROM stdin;
    public          postgres    false    208   c      *          0    17023    univ 
   TABLE DATA           9   COPY public.univ (id, nama, alamat, kota_id) FROM stdin;
    public          postgres    false    219   oc      V           0    0    akun_id_seq    SEQUENCE SET     :   SELECT pg_catalog.setval('public.akun_id_seq', 14, true);
          public          postgres    false    203            W           0    0    daftar_omb_id_seq    SEQUENCE SET     @   SELECT pg_catalog.setval('public.daftar_omb_id_seq', 46, true);
          public          postgres    false    246            X           0    0    detail_pendidikan_id_seq    SEQUENCE SET     G   SELECT pg_catalog.setval('public.detail_pendidikan_id_seq', 44, true);
          public          postgres    false    234            Y           0    0    detail_prestasi_id_seq    SEQUENCE SET     E   SELECT pg_catalog.setval('public.detail_prestasi_id_seq', 19, true);
          public          postgres    false    238            Z           0    0    detail_wali_id_seq    SEQUENCE SET     A   SELECT pg_catalog.setval('public.detail_wali_id_seq', 37, true);
          public          postgres    false    230            [           0    0    detail_wali_kelurahan_id_seq    SEQUENCE SET     K   SELECT pg_catalog.setval('public.detail_wali_kelurahan_id_seq', 1, false);
          public          postgres    false    232            \           0    0    detail_wali_pendaftaran_id_seq    SEQUENCE SET     M   SELECT pg_catalog.setval('public.detail_wali_pendaftaran_id_seq', 1, false);
          public          postgres    false    231            ]           0    0    fakultas_id_seq    SEQUENCE SET     =   SELECT pg_catalog.setval('public.fakultas_id_seq', 3, true);
          public          postgres    false    211            ^           0    0    hasil_penerimaan_id_seq    SEQUENCE SET     F   SELECT pg_catalog.setval('public.hasil_penerimaan_id_seq', 55, true);
          public          postgres    false    241            _           0    0    hasil_penerimaan_kode_skpm_seq    SEQUENCE SET     O   SELECT pg_catalog.setval('public.hasil_penerimaan_kode_skpm_seq', 1029, true);
          public          postgres    false    244            `           0    0    jalur_pendaftaran_id_seq    SEQUENCE SET     F   SELECT pg_catalog.setval('public.jalur_pendaftaran_id_seq', 4, true);
          public          postgres    false    205            a           0    0    jenis_pembayaran_id_seq    SEQUENCE SET     E   SELECT pg_catalog.setval('public.jenis_pembayaran_id_seq', 5, true);
          public          postgres    false    223            b           0    0    jenjang_id_seq    SEQUENCE SET     <   SELECT pg_catalog.setval('public.jenjang_id_seq', 3, true);
          public          postgres    false    209            c           0    0    kecamatan_id_seq    SEQUENCE SET     @   SELECT pg_catalog.setval('public.kecamatan_id_seq', 186, true);
          public          postgres    false    228            d           0    0    kelurahan_id_seq    SEQUENCE SET     A   SELECT pg_catalog.setval('public.kelurahan_id_seq', 2441, true);
          public          postgres    false    227            e           0    0    kota_id_seq    SEQUENCE SET     :   SELECT pg_catalog.setval('public.kota_id_seq', 31, true);
          public          postgres    false    229            f           0    0    pembayaran_id_seq    SEQUENCE SET     @   SELECT pg_catalog.setval('public.pembayaran_id_seq', 53, true);
          public          postgres    false    224            g           0    0    pendaftaran_id_seq    SEQUENCE SET     A   SELECT pg_catalog.setval('public.pendaftaran_id_seq', 40, true);
          public          postgres    false    221            h           0    0    pengumuman_id_seq    SEQUENCE SET     ?   SELECT pg_catalog.setval('public.pengumuman_id_seq', 6, true);
          public          postgres    false    247            i           0    0    prodi_id_seq    SEQUENCE SET     :   SELECT pg_catalog.setval('public.prodi_id_seq', 2, true);
          public          postgres    false    213            j           0    0    provinsi_id_seq    SEQUENCE SET     =   SELECT pg_catalog.setval('public.provinsi_id_seq', 7, true);
          public          postgres    false    226            k           0    0    registrasi_ulang_id_seq    SEQUENCE SET     F   SELECT pg_catalog.setval('public.registrasi_ulang_id_seq', 24, true);
          public          postgres    false    242            l           0    0    sekolah_id_seq    SEQUENCE SET     <   SELECT pg_catalog.setval('public.sekolah_id_seq', 3, true);
          public          postgres    false    236            m           0    0    tahun_akademik_id_seq    SEQUENCE SET     C   SELECT pg_catalog.setval('public.tahun_akademik_id_seq', 2, true);
          public          postgres    false    207            \           2606    16930    akun akun_email_key 
   CONSTRAINT     O   ALTER TABLE ONLY public.akun
    ADD CONSTRAINT akun_email_key UNIQUE (email);
 =   ALTER TABLE ONLY public.akun DROP CONSTRAINT akun_email_key;
       public            postgres    false    204            _           2606    17081    akun akun_pkey 
   CONSTRAINT     L   ALTER TABLE ONLY public.akun
    ADD CONSTRAINT akun_pkey PRIMARY KEY (id);
 8   ALTER TABLE ONLY public.akun DROP CONSTRAINT akun_pkey;
       public            postgres    false    204            }           2606    25222 (   detail_pendidikan detail_pendidikan_pkey 
   CONSTRAINT     f   ALTER TABLE ONLY public.detail_pendidikan
    ADD CONSTRAINT detail_pendidikan_pkey PRIMARY KEY (id);
 R   ALTER TABLE ONLY public.detail_pendidikan DROP CONSTRAINT detail_pendidikan_pkey;
       public            postgres    false    235            �           2606    25267 $   detail_prestasi detail_prestasi_pkey 
   CONSTRAINT     b   ALTER TABLE ONLY public.detail_prestasi
    ADD CONSTRAINT detail_prestasi_pkey PRIMARY KEY (id);
 N   ALTER TABLE ONLY public.detail_prestasi DROP CONSTRAINT detail_prestasi_pkey;
       public            postgres    false    239            �           2606    25280 &   hasil_penerimaan hasil_penerimaan_pkey 
   CONSTRAINT     d   ALTER TABLE ONLY public.hasil_penerimaan
    ADD CONSTRAINT hasil_penerimaan_pkey PRIMARY KEY (id);
 P   ALTER TABLE ONLY public.hasil_penerimaan DROP CONSTRAINT hasil_penerimaan_pkey;
       public            postgres    false    240            y           2606    17076 &   jenis_pembayaran jenis_pembayaran_pkey 
   CONSTRAINT     d   ALTER TABLE ONLY public.jenis_pembayaran
    ADD CONSTRAINT jenis_pembayaran_pkey PRIMARY KEY (id);
 P   ALTER TABLE ONLY public.jenis_pembayaran DROP CONSTRAINT jenis_pembayaran_pkey;
       public            postgres    false    222            p           2606    17006    kecamatan kecamatan_pkey 
   CONSTRAINT     V   ALTER TABLE ONLY public.kecamatan
    ADD CONSTRAINT kecamatan_pkey PRIMARY KEY (id);
 B   ALTER TABLE ONLY public.kecamatan DROP CONSTRAINT kecamatan_pkey;
       public            postgres    false    217            r           2606    17011    kelurahan kelurahan_pkey 
   CONSTRAINT     V   ALTER TABLE ONLY public.kelurahan
    ADD CONSTRAINT kelurahan_pkey PRIMARY KEY (id);
 B   ALTER TABLE ONLY public.kelurahan DROP CONSTRAINT kelurahan_pkey;
       public            postgres    false    218            m           2606    16996    kota kota_pkey 
   CONSTRAINT     L   ALTER TABLE ONLY public.kota
    ADD CONSTRAINT kota_pkey PRIMARY KEY (id);
 8   ALTER TABLE ONLY public.kota DROP CONSTRAINT kota_pkey;
       public            postgres    false    216            {           2606    17101    pembayaran pembayaran_pkey 
   CONSTRAINT     X   ALTER TABLE ONLY public.pembayaran
    ADD CONSTRAINT pembayaran_pkey PRIMARY KEY (id);
 D   ALTER TABLE ONLY public.pembayaran DROP CONSTRAINT pembayaran_pkey;
       public            postgres    false    225            w           2606    17043    pendaftaran pendaftaran_pkey 
   CONSTRAINT     Z   ALTER TABLE ONLY public.pendaftaran
    ADD CONSTRAINT pendaftaran_pkey PRIMARY KEY (id);
 F   ALTER TABLE ONLY public.pendaftaran DROP CONSTRAINT pendaftaran_pkey;
       public            postgres    false    220            �           2606    25395    pengumuman pengumuman_pkey 
   CONSTRAINT     X   ALTER TABLE ONLY public.pengumuman
    ADD CONSTRAINT pengumuman_pkey PRIMARY KEY (id);
 D   ALTER TABLE ONLY public.pengumuman DROP CONSTRAINT pengumuman_pkey;
       public            postgres    false    248            g           2606    16971    fakultas pk_fakultas 
   CONSTRAINT     R   ALTER TABLE ONLY public.fakultas
    ADD CONSTRAINT pk_fakultas PRIMARY KEY (id);
 >   ALTER TABLE ONLY public.fakultas DROP CONSTRAINT pk_fakultas;
       public            postgres    false    212            a           2606    16941 &   jalur_pendaftaran pk_jalur_pendaftaran 
   CONSTRAINT     d   ALTER TABLE ONLY public.jalur_pendaftaran
    ADD CONSTRAINT pk_jalur_pendaftaran PRIMARY KEY (id);
 P   ALTER TABLE ONLY public.jalur_pendaftaran DROP CONSTRAINT pk_jalur_pendaftaran;
       public            postgres    false    206            e           2606    16961    jenjang pk_jenjang 
   CONSTRAINT     P   ALTER TABLE ONLY public.jenjang
    ADD CONSTRAINT pk_jenjang PRIMARY KEY (id);
 <   ALTER TABLE ONLY public.jenjang DROP CONSTRAINT pk_jenjang;
       public            postgres    false    210            i           2606    16981    prodi pk_prodi 
   CONSTRAINT     L   ALTER TABLE ONLY public.prodi
    ADD CONSTRAINT pk_prodi PRIMARY KEY (id);
 8   ALTER TABLE ONLY public.prodi DROP CONSTRAINT pk_prodi;
       public            postgres    false    214            c           2606    25405     tahun_akademik pk_tahun_akademik 
   CONSTRAINT     ^   ALTER TABLE ONLY public.tahun_akademik
    ADD CONSTRAINT pk_tahun_akademik PRIMARY KEY (id);
 J   ALTER TABLE ONLY public.tahun_akademik DROP CONSTRAINT pk_tahun_akademik;
       public            postgres    false    208            k           2606    16991    provinsi provinsi_pkey 
   CONSTRAINT     T   ALTER TABLE ONLY public.provinsi
    ADD CONSTRAINT provinsi_pkey PRIMARY KEY (id);
 @   ALTER TABLE ONLY public.provinsi DROP CONSTRAINT provinsi_pkey;
       public            postgres    false    215                       2606    25242    sekolah sekolah_pkey 
   CONSTRAINT     R   ALTER TABLE ONLY public.sekolah
    ADD CONSTRAINT sekolah_pkey PRIMARY KEY (id);
 >   ALTER TABLE ONLY public.sekolah DROP CONSTRAINT sekolah_pkey;
       public            postgres    false    237            t           2606    17030    univ univ_pkey 
   CONSTRAINT     L   ALTER TABLE ONLY public.univ
    ADD CONSTRAINT univ_pkey PRIMARY KEY (id);
 8   ALTER TABLE ONLY public.univ DROP CONSTRAINT univ_pkey;
       public            postgres    false    219            ]           1259    17082    akun_id    INDEX     6   CREATE INDEX akun_id ON public.akun USING btree (id);
    DROP INDEX public.akun_id;
       public            postgres    false    204            n           1259    17022    fki_kecamatan_kota    INDEX     K   CREATE INDEX fki_kecamatan_kota ON public.kecamatan USING btree (kota_id);
 &   DROP INDEX public.fki_kecamatan_kota;
       public            postgres    false    217            u           1259    17057    fki_pendaftaran_akun_id_fkey    INDEX     W   CREATE INDEX fki_pendaftaran_akun_id_fkey ON public.pendaftaran USING btree (akun_id);
 0   DROP INDEX public.fki_pendaftaran_akun_id_fkey;
       public            postgres    false    220            �           2606    25268 3   detail_prestasi detail_prestasi_pendaftaran_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.detail_prestasi
    ADD CONSTRAINT detail_prestasi_pendaftaran_id_fkey FOREIGN KEY (pendaftaran_id) REFERENCES public.pendaftaran(id);
 ]   ALTER TABLE ONLY public.detail_prestasi DROP CONSTRAINT detail_prestasi_pendaftaran_id_fkey;
       public          postgres    false    2935    220    239            �           2606    25208 )   detail_wali detail_wali_kelurahan_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.detail_wali
    ADD CONSTRAINT detail_wali_kelurahan_id_fkey FOREIGN KEY (kelurahan_id) REFERENCES public.kelurahan(id);
 S   ALTER TABLE ONLY public.detail_wali DROP CONSTRAINT detail_wali_kelurahan_id_fkey;
       public          postgres    false    218    2930    233            �           2606    25203 +   detail_wali detail_wali_pendaftaran_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.detail_wali
    ADD CONSTRAINT detail_wali_pendaftaran_id_fkey FOREIGN KEY (pendaftaran_id) REFERENCES public.pendaftaran(id);
 U   ALTER TABLE ONLY public.detail_wali DROP CONSTRAINT detail_wali_pendaftaran_id_fkey;
       public          postgres    false    2935    220    233            �           2606    25281 5   hasil_penerimaan hasil_penerimaan_pendaftaran_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.hasil_penerimaan
    ADD CONSTRAINT hasil_penerimaan_pendaftaran_id_fkey FOREIGN KEY (pendaftaran_id) REFERENCES public.pendaftaran(id);
 _   ALTER TABLE ONLY public.hasil_penerimaan DROP CONSTRAINT hasil_penerimaan_pendaftaran_id_fkey;
       public          postgres    false    2935    220    240            �           2606    25286 /   hasil_penerimaan hasil_penerimaan_prodi_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.hasil_penerimaan
    ADD CONSTRAINT hasil_penerimaan_prodi_id_fkey FOREIGN KEY (prodi_id) REFERENCES public.prodi(id);
 Y   ALTER TABLE ONLY public.hasil_penerimaan DROP CONSTRAINT hasil_penerimaan_prodi_id_fkey;
       public          postgres    false    240    2921    214            �           2606    17017     kecamatan kecamatan_kota_id_fkey    FK CONSTRAINT     ~   ALTER TABLE ONLY public.kecamatan
    ADD CONSTRAINT kecamatan_kota_id_fkey FOREIGN KEY (kota_id) REFERENCES public.kota(id);
 J   ALTER TABLE ONLY public.kecamatan DROP CONSTRAINT kecamatan_kota_id_fkey;
       public          postgres    false    216    217    2925            �           2606    17012 %   kelurahan kelurahan_kecamatan_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.kelurahan
    ADD CONSTRAINT kelurahan_kecamatan_id_fkey FOREIGN KEY (kecamatan_id) REFERENCES public.kecamatan(id);
 O   ALTER TABLE ONLY public.kelurahan DROP CONSTRAINT kelurahan_kecamatan_id_fkey;
       public          postgres    false    217    218    2928            �           2606    16997    kota kota_provinsi_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.kota
    ADD CONSTRAINT kota_provinsi_id_fkey FOREIGN KEY (provinsi_id) REFERENCES public.provinsi(id);
 D   ALTER TABLE ONLY public.kota DROP CONSTRAINT kota_provinsi_id_fkey;
       public          postgres    false    2923    215    216            �           2606    17105 .   pembayaran pembayaran_jenis_pembayaran_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.pembayaran
    ADD CONSTRAINT pembayaran_jenis_pembayaran_id_fkey FOREIGN KEY (jenis_pembayaran_id) REFERENCES public.jenis_pembayaran(id) NOT VALID;
 X   ALTER TABLE ONLY public.pembayaran DROP CONSTRAINT pembayaran_jenis_pembayaran_id_fkey;
       public          postgres    false    2937    225    222            �           2606    17110 )   pembayaran pembayaran_pendaftaran_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.pembayaran
    ADD CONSTRAINT pembayaran_pendaftaran_id_fkey FOREIGN KEY (pendaftaran_id) REFERENCES public.pendaftaran(id) NOT VALID;
 S   ALTER TABLE ONLY public.pembayaran DROP CONSTRAINT pembayaran_pendaftaran_id_fkey;
       public          postgres    false    220    225    2935            �           2606    17083 $   pendaftaran pendaftaran_akun_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.pendaftaran
    ADD CONSTRAINT pendaftaran_akun_id_fkey FOREIGN KEY (akun_id) REFERENCES public.akun(id);
 N   ALTER TABLE ONLY public.pendaftaran DROP CONSTRAINT pendaftaran_akun_id_fkey;
       public          postgres    false    204    220    2911            �           2606    17044 1   pendaftaran pendaftaran_jalur_pendaftaran_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.pendaftaran
    ADD CONSTRAINT pendaftaran_jalur_pendaftaran_id_fkey FOREIGN KEY (jalur_pendaftaran_id) REFERENCES public.jalur_pendaftaran(id);
 [   ALTER TABLE ONLY public.pendaftaran DROP CONSTRAINT pendaftaran_jalur_pendaftaran_id_fkey;
       public          postgres    false    2913    206    220            �           2606    25294 '   pendaftaran pendaftaran_kelurahan_id_fk    FK CONSTRAINT     �   ALTER TABLE ONLY public.pendaftaran
    ADD CONSTRAINT pendaftaran_kelurahan_id_fk FOREIGN KEY (kelurahan_id) REFERENCES public.kelurahan(id);
 Q   ALTER TABLE ONLY public.pendaftaran DROP CONSTRAINT pendaftaran_kelurahan_id_fk;
       public          postgres    false    218    220    2930            �           2606    25248 '   pendaftaran pendaftaran_prodi_1_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.pendaftaran
    ADD CONSTRAINT pendaftaran_prodi_1_id_fkey FOREIGN KEY (prodi_1_id) REFERENCES public.prodi(id) NOT VALID;
 Q   ALTER TABLE ONLY public.pendaftaran DROP CONSTRAINT pendaftaran_prodi_1_id_fkey;
       public          postgres    false    220    214    2921            �           2606    25253 '   pendaftaran pendaftaran_prodi_2_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.pendaftaran
    ADD CONSTRAINT pendaftaran_prodi_2_id_fkey FOREIGN KEY (prodi_2_id) REFERENCES public.prodi(id) NOT VALID;
 Q   ALTER TABLE ONLY public.pendaftaran DROP CONSTRAINT pendaftaran_prodi_2_id_fkey;
       public          postgres    false    2921    220    214            �           2606    25299 .   detail_pendidikan pendidikan_pendaftaran_id_fk    FK CONSTRAINT     �   ALTER TABLE ONLY public.detail_pendidikan
    ADD CONSTRAINT pendidikan_pendaftaran_id_fk FOREIGN KEY (pendaftaran_id) REFERENCES public.pendaftaran(id);
 X   ALTER TABLE ONLY public.detail_pendidikan DROP CONSTRAINT pendidikan_pendaftaran_id_fk;
       public          postgres    false    235    2935    220            �           2606    16982    prodi prodi_fakultas_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.prodi
    ADD CONSTRAINT prodi_fakultas_id_fkey FOREIGN KEY (fakultas_id) REFERENCES public.fakultas(id);
 F   ALTER TABLE ONLY public.prodi DROP CONSTRAINT prodi_fakultas_id_fkey;
       public          postgres    false    2919    212    214            �           2606    25319 :   registrasi_ulang registrasi_ulang_hasil_penerimaan_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.registrasi_ulang
    ADD CONSTRAINT registrasi_ulang_hasil_penerimaan_id_fkey FOREIGN KEY (hasil_penerimaan_id) REFERENCES public.hasil_penerimaan(id);
 d   ALTER TABLE ONLY public.registrasi_ulang DROP CONSTRAINT registrasi_ulang_hasil_penerimaan_id_fkey;
       public          postgres    false    2947    240    243            �           2606    25324 /   registrasi_ulang registrasi_ulang_prodi_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.registrasi_ulang
    ADD CONSTRAINT registrasi_ulang_prodi_id_fkey FOREIGN KEY (prodi_id) REFERENCES public.prodi(id);
 Y   ALTER TABLE ONLY public.registrasi_ulang DROP CONSTRAINT registrasi_ulang_prodi_id_fkey;
       public          postgres    false    2921    243    214            �           2606    25243    sekolah sekolah_kota_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.sekolah
    ADD CONSTRAINT sekolah_kota_id_fkey FOREIGN KEY (kota_id) REFERENCES public.kota(id) NOT VALID;
 F   ALTER TABLE ONLY public.sekolah DROP CONSTRAINT sekolah_kota_id_fkey;
       public          postgres    false    237    216    2925            �           2606    17031    univ univ_kota_id_fkey    FK CONSTRAINT     t   ALTER TABLE ONLY public.univ
    ADD CONSTRAINT univ_kota_id_fkey FOREIGN KEY (kota_id) REFERENCES public.kota(id);
 @   ALTER TABLE ONLY public.univ DROP CONSTRAINT univ_kota_id_fkey;
       public          postgres    false    2925    219    216               W  x���K��<����p1ۉ����.J{ǚ�"�\D���3�=v��R$�ʻ�So�9AB��[�S�{��V�q`E��|�e����ߝ���`}�8����Y5G��&e�/£�9��<KՈ����+��K�|�����tWj��UK�50��'�?!�@RC�� ��$�J�s	�qc�'N;���a�K5;�����٘��H=�A�����ϴ�~�Ӟv�x�.�f�h4}�Ŭ�DP�`�ByB%�mŷ����}$������B�jZпVWd�3���1$�ui��w�`K��D
�		�! c�����d2�	�aR���"x�B7@ƨUw�k��A/C�opKwA5w��G�]~�f����AY�+���@
E�D�(��nT�P8V\����z$��sm��gI�X(k��k�h�퇭����0����N$�?��m@�7�HH�J@	C�D b��0��'	�o�~�j16׷�oH�%l_����`�9#e��e�����UX��̧�y�{�B��P�H5\�)A�Ya[�{7$YH�!X����>}=��@p]�ܓNC1k�3Ⱦ?nw�G;��⺲��h�q��n&���Y�� �E��Wd�(J�	�_��b>B���Px턎��G&�l��#"Au29�/�5�:��|�� N�1�
�JG0��"�dα�J*�*
 ��̫����`g�{�{��<���TqT�x��:�= ��nq�~+�8Uwn�ݔ$����_�"�pS@%	!�J��`�e^x_��6\�?��p"qL^I�F�T�kzg�VԂa�^�YH8ނ�0�=�����&�䬬ۄ��� ``X��6ɹ5=ԕ�Y�͕���$�;f�������4K�7��?F�+��ZT0=�0t�����H��co�}~>�M�z��]�ˍ��6�N�>ӓ:Cգ-5�yȂ��LI���,aY��������a���'�F�n6���'W#��a]K��I�zu ��~���z�7�8W�^��/�\��mb*����%T��wB*��Mdm����o�ϯ���aG1s����h�\��k�5�x�t�M��/���WM�Nf{�G�WCq���ʷA���T�
&To������N�[�      D   S   x���� ki��!;@Z��#&��tz�A�Aݐc�A+P�~i�:���,"`�I�0a�R[̽jf�y8)��E��E�      :   &  x��Wˎ�]wE~ �AVq)`  �Eƛ ��)����~�}'r����홾,��F�����G�*�|����[�x+���ߏҦw3mur�CF��G��f���}URl���;� 
�@�(\�����,��e���6�Z1�>)k�K��K�cR!4���eL�s��B=����.]�ܵ�����*I��3���mUS���{���Z㘚G�uv���d�4�Dc+5���{�):Lv5:�Z��vX�KL�v�Ż�t9�%K�5�ˍY�F�Z��4��e}��V�H)�e�QKI᭞=;����̓Xיqϫ��B+�^�cm�Y��J	�g��Lm�&�<-$�a�0R������I�.��G��k�;bT�%y�ҵE�T�F� �X�k�(v�3��PP{0F�����f�DOcC��I������������_���~�Z~���J���Z������X{bs�vi�9[	,�F]��xK�Do���뜳���V<�qq��*)@ ��1K��ze��tW�.�8��bk��p@&kh���jL�$��ǝݗ�y���O��P��7Q�S\|||}��������"kRb����zUbi�r�6�
Xn]rh�s2�k�z��!��l�+ƥ�ˇח�/[J�Á�����^�2�L�5NE��]����A��QYG[���㉝���}��(=f�"�ܽ�q���[���,�Z{�1���[�[�{��N�?��M$ b� *�X�[��k�2��Տ�_D���� �7!�N(�{���@n`�M:q%��Z$��%�%���9A�!�w�s�'�Q擞�1	(��� �e�wԅ-�8Y�;d��(�q$�x�a|-�t�$݈1����d����Ҁ�Z���!}�$\��z!?���'�(j)U�ydGk#�(Uu���l ���P��D6'�=y�S���T4���/��u@��1.U����c�b��#�&�@m�Q�Ұ�
-\�pm�����g1�t]W��Ȃ�k�%^��d�T9��=�������+��q��2���{����oL��*�3�.h�����F�$o���(AV�x(��4hAKRp����O��Kmva4V��^�}��'�tt�Y�2�יi�� J���5fx[��[U���&>��[���?���X&�\WAN)f�1M8:�T�V�ȷo%+Z�8�Ś������I}V���z�o����Ua�x}����X=O@�� @��6Ts������V0]PQ|D1U%8��!o����_�v�d�\�2I�P��h$CM�L�+tB^��Vˊ<A b��o�Nܸ�z�����jA�ªİL��s8�9�C�-�!�6�6yG�6���\p0�`�JȄ���O��������ǯ��S��Q���K�����F���a���FD8.��ъ� 8���e;)�KO��>�I�ZK�k	m�xhnF'��y�tD��Z�<`m�fi'�o���J���߬��������j�A��u�� �c�0wL�z�����S���Cw�r���ɝ0��[E9����@I���BQ���ZG��^c��~�$�i��b;^;AT,!��9��~(�L�F���ߚ�*��crN�;N8
߱]��5�	QgE�1��ߊO@�;�R.�#W<�d��lmŤ�$�D��@T��P�>ґ�� Ƞ����j��M��yPy�z���P�������'��Zn�O$��0\��7@ƛ ��ڐ�Sûj�椌��ԧ���W�Av����?�0��#��]��KF[Bw����w�y�B���      >   h  x�]�Ko!����<��>X�6R��/�@G��%k���$��UE
%<;>��@$�����|�����0�Hx� �����g�0o���D�TՑ[�hi��<&����k��y�r��9��8���E����{-Y�M�@5�a�� LWV����!yuo����c��aG�;ą@�sd�1b�م��H�*m'�[º�X�h�M�֚�+)�Zg��L�!nS���rj�1R-ټs��%BJ�0%P�/��!Jc���`��� {I�v��O�o��O+�Y�z�ә�B�����ꇷuV[_�����i\?�kqfX<�Ru�Y����:�v^˲|���      8   V  x��V�r�6}^}��*q#�7��Rq�f:#w<���4#Y�I����{�n�-i-.	^���=�PJYKRH%&SEB	��R���]��f�6�������mV�w�������+[���t��խ�-[zdu	(�I��ӗ�,׳O�t�yF��#!I��������LI���ٟ����TJMs���u�ͼҽ�D��Ļ9�4����ۋ�߸rݏ7�n;.݆�g�g�ry��7G><<���.�q��ލ��/�Hdy��A�d�E�O���"�.�>@�w�r���e��ф&�g���s��8g���B�N�v8<��.��!1�������>�8��k��^���e#��h4%9�)��^�j��@�ߺ%��D	bb��hF�|ۜ}���zmY-���\���mq����P�byS�\�ZWK\���k�ةs��AK�9����4+Dw�ɔD��ރ��"Ú3-��0��3��G8Ì=l��Ck���FI�F�>D
;[uop�#�� �/qzL(*�fp�	"Q�q���K�J����ب$��Z�I�Z�477�/r����A(��'&fB�F���q�F�T�0�T�'Օc�V�/f,�����<
Va���F	����aO�F��dk��o�ʞ�W��&�#�u,#��<�G�Ӿ�.�����f�yZ'N��G�����r<ψ� �����ُ�g#>�ϱ�w숖��2#<!0Ϡ�)�����ך�E�@�0 d@F��LG��<;O���x��|�����[Ȣ�$�@�olC����5�]�@��� 4\�����@�_W�`��#��q�y�۶/[m���Ǒ!,u�VªN!�Ӧ���`�A�#�t�#����5�!��=��Ԗ��8�&��S;������Mk���zK�~��/�K Z�)�\�&��+����ӄ��h���*/BR:�"�����"����0�0��^�:5��i����#������봃���TաD|WM�WO!�>",>-<%�������C��4e��L�A(KMf�<���\�H5�X����t�~l���3!!�=�W��6����4S/y��-��x4�da�      #   �   x�}̱
�0��y��@C�QPpspt9�ʑ�M}�
����ϼQ���H���U^u]��a�8BЀٺ��чNR���R�.\H?I�p�_}�GB�ܮަu#��S�7	�S'��QJ}w@�      ?   �  x�u�Kn�0D������.@��e��TK9�����P$��K\�0���,�������ǧº\se�AR�����W�*�N
&�{�b�����X�ɰO'���gf.�K��N3�FJ�g���4�o.㊨�W;wnBQR(�Pqqb+�Ҡ��yIX��)0O7�� 5�#	�=�����o�})�j�<�fR�\��ӂ����/0�L�Ig�%�qP����NEX��`��|�-�<@T�D��|z������m�j�M��˯�/���[�1%:�HP�{p��0)��]�Π/kHk�})'�)�`ȘPĹ}W����A��UR=�qV<��n�Q�|�T>���@Op��{ŝ"���pS��>�X����(|�;�O`d�uj�0D&y���ڹ�#J)�����6�%��'ˉc@K���pq�ӊ��l]y���m�]��l���������c�A�Vڣ�غ��`�)j1d��8���X)%���7��{���j�9����@�$YGU%'�Z�í�oe7Q���xt�Ø}�s/^fUCa�LpS�{����/.�[�x(��\��=ػL!��{�%����'Q���� Ue��X���-��I�sV��;̓�"�Gl���۴.�e�DPt�P"
���=�5tJ�Y���U�\uo��	Z�?�J�b��Z|?�>���S�c-����s�c�v�?9�?�(տ���r֜Y         i   x�}���0k<E��{v���@CO���P>���{2�iY�-����'�2*G�V�D�j>�/^�o$�z��b�@�A��~��Y��Z؀��dV9 �93E      -   F   x�3�t
����2�t�3�9}�R2�2ASΒ�b���┘����Ĵ�b H��  "�=... �.      !   P   x�}ɱ� ���r�QA;He���H����g��EPXQ�։�ͤ[E�����c�.�i��N�o*�1ŏ0�tW"d      (   �  x�e��n�8������B�Y�q[�M�Q9@/zCׄ��d�b�y���C����"9Ù�o�	��U^�R5r�����!-u�Lc�ԭ�F�܍�H,^�Qu��L�>�qj�6��?�F��2/���+v�&�����
XJ�U�nh(�e쿎�e� }6؁>4�vb{�]�?ˎ��y���=�y��,��)�F�= ��������$Yi>_���N�+���7� d#O���K�{��(�����/K]����k����v��1`�Zy�P���`<���$�ڢ���˓:�[g�e:9ph�`��,, ��n�EQ�|GQ@kBÛ{�Hx���E);
1z��|�,���d�ۃT���7�I	-cF�(�%gd
�Nا曈2/�7+�{�r�Ho�kc*7!0��3e_I%�6y�`/�W;��k��N�]c�4�q�7���?��q
H�(>x����)��qD���W�Z��j�H��/<	�K,4��GZ��g"�)g�cߞ�M��W!�n�$i��$�/5����;:R��qJp��r�ƥ>I:�K�ۙ��:����-S���-�3!�� ���j-	>����|�0"X�k�N�4&tD����$xx#��hÒ���E*�	-�28¡FsΦ9����n>-��deN8��e����ege®���;i�"o7i��p�{S��b�ńK]#��$˼��e)Ϻ����eي/�s�'���M�'���L�xg:Wv���Fޤ��^���8J��yHvd2� ��Q\�#��V�2\yL�QW����bB�F,�I��S�;�|��[��n��gĿ�F#�w������)��qA�����aG��`^����V�EWAC���"$��z�e�h��""^j�7�fELhgNx�~�-�"!��7zB%�H���c��]D��{�����!9Q� }5|�b�)��,�=W���>��BB;�J<��e?��H�4&ʮ<6�?$D��F�?�Z"����ud����!#�h��&�����N��,T���-�9�W�ߛ������DsFƂ��n{~%J�`~��b1����?F��6�ؐxx�
��)pwa0E�ΐ��T(4}v�$_���:Y�+���,l �������
=��gE]kB!��tzB��jT,T 0v�1��<!����!�J*�r�!�Bjq�lq�@��F�=���8�/�@H-�{@V�Z�M�A���ۇ2��6����ĝ�M� � ��xwܗ1��g{ڕC
� �wv	�@5�K�@v>�Z�ď���PL}�
����& ��vl�3���K�R^�m����h�3!/`�������il��ɴ�$�����z��i�M2�9��)�ْ�������p�d��k��I4��}�i������s$$�nNMq�� �I��v�Am �6��7d��/!�Q�*3�u�H��lW��l�a�i��(�k�1?0>u���{l�ݻ�$������ �����E@�6ٛ����Z8����h���Yl��_��aj'ۈu�C��|c=�)�5��i>8�*��m���+����$$Ey�E�<&3_~JA���}�_f N�������(��B%^���;�,��"+wKP' �i��@a��4����( Q���~s	]e��g!+�T�7�T#?l�p��8��@%ם��@����g�Kon��0�����W� >�$ ~�����o�1z      )      x�}��r$9�$�L~E<��PG��de�\HfQH��#�ř�:cqND�����QU�=�%#ҝEW  3lf���]�6�nح.��~^���yk����Ь�Ͷ96���ծY\������t�i���a���v�Z7�f}Y�n^�U�5>n��)�ˀ��a��k~7vK&����	魺K�f�|C�Kw*���H��8�d�t$�f8,�ϥ�����k��~}�(�5#.��vs�(�Ӿ�L,W��w-��,�}k��U{���
��w;���o m��a�=���9�3|ܚR>���j���zD�J��װf
o���M���N�*� ��j���(�Ml,���)6j�z������Ne�Q$���n@�^f��W�ڸ�(�ն鎨��ݰ�ˬ��;��ڬ�Ut@��j�y�R�6Y�>_ �e�r��E��\�1X@���ǰ��g����6c��?���Z_1�a�%����'*�2�Hw��(��]����t���X*��w��,(��k��L1��a��m�~@)�����y�,�����p�,J�y=X�_w/��H�_�eQ�M�_=7��\���n����SLk2��ǡ[�v�w�}Þ�����Y���%EQP՗�>�����.��O�kw�,k�y�����s�̖T-���z��n��;���������-�����c�U�%b��*���v���/��_��V�~8�ӷdЇ�}�~YQ k��5EB�|n/k�3�]3��lPL�u�����2v<� ��7�g}Y@>;j��˺r�*9�C$R��nh �������:����]��,?b�O�N]끺����_��S�.�4.6+�I�g��i ��Ͱ^|�Y����/�h
=t��e����X{�5�/ͦG�]���8ph�q��E`���s�[:͡�#�[z`Jg�[�Z�s���-s��J��>Mʫ-�Ry����s�bcx5�z��!ܲ&�� ,4�	@�M��~���%p�2�* �$q��Z�������B�dG�RƎҢ�u��ٺ"�(�������sl7ͪY�8��T}���w��<�$�"�l�ԇ̦�>k����6�C�1��b�n����L��� 4�=t~�3,��]�DIx2&%y�����O�����a�  s��v��������8�@���Ƿ�^O�� 2�M��������Jf�I�+�Ю*c���{o��so�3���O���?;��2�k���@�|iy��$m�0���%�}�?����(N�6�<��{��⻰�Zw���(G1�%�՘�_�K��(�Ε[\�(�(�K��!�.V�G�fO�f��}c]&	�C�nQ��H����vP�(X%�O�;�-i��k�v4�@ �o�e�[򇵲C�v�����*�`�&��(�V4��v���(���� �Rb�x?.�v���{�xHx�a�05�����������p�_<�����-Q�����乕DFW������#�رgm?CE;@7{���e����(�i�p���;:%�
�L
,w��0�Ār��l5�;�B (�o-l#DB)�$���dx����(��(<�D|[���{�f���~��0������2
�J���;�` ��i�}��#K��������Y8���~ľıXF�j�Vo}���ɸ�9�:�CXO�۾/>�;��'�O�����׃���O0����R�1=��'G*�SE��R:XW�j����R��xZj0���;��\�0���v@}��m�� 3������)��{l.����4h@��@�Qt�l�0�.�f�$ԁ���5yX�1F�*�F�?	�X���Q�ɘ��r��y2s���ы�0�0I�ʨ=�qZu��A������X�>?o��=[f/������ogc ����lѻ��0�lL�ݾ�} ��q����H��s�8��62=�Դ�hm�a(�vo��9i�aC���q�~9�sk����K)��M�QIx��н.�05T&>�R���c�T�􁇃{�"u�~]��̪ �/����y�/�`弱��м�Z����+Z<R͖c4T��ϤR�M^W��̟H �2����P����R@1\�J���j���.9�궘�����.c���d���䢮�}�	�~���A?��G[��G�1+^O3n�-A�0Y-��f8�w�m�=�����B>��z���L[I8)���=��RA��ϫQ�;���O�ې��Թr��`/b+*$�J�S*�円q�0b���7)�g'��1�����|�{g��0ٛ�{D,k!����Ԛia5�vdu
(j�p!�H�U}Fœm��r�*[7�w���!,�wVBO��w�eĬ��B8�q"�+A`�zXr�9� k�Kb�[ZD]�R�!��ڮ��-���W�0�win��y��;!)�D���	���5-��D���}ôP~&�-�u��xҫ�n���&��s���ںo����P;��L�8��d�@9���y�z�c�ځ�Oy�-n�d��ԟ�d���{?�@y����T���C6�jifV��e����=>��4J�/u��y�p�VK+���z�;�{&���&Ul�,�#����a���Z�t����$$-݅z�y�X��c����'��.���y��&�*�?(�A�{o�P'�0�c���S=��̺̬A�ti����PI�O�3[Nz��t/\�,e?��` ��gT��E���Z���bʲ��=�8�ϸ�' �ϼ	.�l(?�O�?��� O���y=��. �ё|մ8��$�^`A&똚f ��o��X5��S{X��$.�pP8�
�G=R�=r�һ��oe^�ȕ�1)��$al��T����K@R��D�ߋ�^]:�6OpQׄ���6iQ*��Ĕ�*Ϥ��&�y����0L�~��AYaN�c�}BW��3d�j����,��1ד�L����@f:���sq����������G`��X��'�p��r�g�B�e�Բ�,N i8�|R�Fa���C��.���
����9��d�i�Ns�:D^��F��������;Z����`�ׯ{dLϠ�g ��+(f3����	hF� ?�GE�!(��f��+&�a�+�=t�2�\>]+'|�&D�߁o6��g����Z��{�/�KIG�ڕ���Y3E,s��	�D�$�v3J���b�ì�<6��E*.A����_P�\E�����iܹ��
Bs�{@�nP�Z���1m{		7�����q�q��'�z9�Q��t�]N�����D�B&���P����5��<�9��\���q+�!��\�y�8�юc�︙��L3��[;F�B��\����_/��u���m*]���٘�4�urq�� �c���h�k�}��+���f��a��F�=a�I���Sl&���4X�l��,6�ܘ�p��m� 鯻}�M��,�&�V'���7��ϲ$�<7�^���Zn�_Ĭ̙�_�L(@&;���X̥��G`kLn�`�!_�
�QL�;_�cҏ�Oæ:�����-���	F��I��{u���sܭ�߇# O(5t�)�L�P�-�<��7��O<��j�bx�i��88��Ni>�ó�
g�'w�Z.˽���1>����M����0s��7M��*���6�X�9��o��P-�/҂P��T��V�VD��ףĩ	X[��!�Eq�ɖi0۷(FX�l9nM���2q��Vs���3j`�ƍH���8�>���"aLpY������N;A��۵�+��~��Պ�q�:�����W�.s�:N�1f!]n���[w_��8-4�GH�_�rwiR�sK���6h%�����%"Ƒv�Ih�K:�E6��z�8�n�M��)Z�]>/�#�q6/����}^x�yӘ�q,/2�1�p��	��;���E,�BR=�tl5E9%޾�����3(Y�-���(%��N[    Hy����CK$�ME��Q���( �
��l��5���|�fv>�2X��Ǝ����KBז0�rS���b����k�7���b�8y�af3��zd�x���f>i`����6��p���A��]�C������v������af�~kt�#��ŗ	��t/@J��������5ˢuAy��aZ3ngl��Er��S�.�ae��ɀuj��u͸O������,,�;���i3!��p6�q��Zm:�0��B�ʕ���(�i��R�@R[�ºf�9ў�`[�e#
#?�Ƨ$��Y�K�T9�h
�z��������HO$���+'���03��f��v���l�WS6�A�~nw��`�\��&LBc�E��w�Qg��[y��8��2�Tbc)���)��ea���^	�!,�G�S� �	��5���͒����.Ts) �7�860���G�A#Y��k����S�S��hH�s�^�|��k�
�gV���6�����[�?5��~�i
g�ST���I,[�)�I�!i�٠Txi�Ǝ�ByIE�詌?�<��Z�������mϭ���F;�\�����RXV8���汌�GFx���&O������	v�∤.��Y�<rj3`����`�\V��,�,����x˓fZNV���4�㯪)���^O�꓌^W�E&-l�P�r�(E~��d��3Lf��M'Z�[v�\��1L�M�����G�lP64�������+���hP�B�`HH�Zq5C�� j�ݡn^���d`�Ӯ�Ϸ=��H�v���k��3~:~^���ӧ������`�@��ote@��߽�1Z�[�_���Vo���_I�����w�C��~�c��W� ^�l4�/S�95/
��<~񗥄����pQ:����k�c�?UV^{Q���4K����2��ÿj� )!��Q�'��)�&V����]�1����X�����l��4���Y-MU�8��WnR(��5*��W�vL�&�п�~O�?6�k�ʧ��a���
�.�-!Q���(��
��u��1	U�ĭYF��o_{�d�Z�n6v�m��_<V�J�%��.�(���p����>�7>�Q=z
D$�c�
w_���Y54�E-��c����-�!���GI_n)�4���iFぞ"H�[dq@OE.�')q��_X�AҪ0�x��</��`D������O�L���[�g�n���SQ��k���� ��D\uǒF�߯��m����g�`��K\ �b�;�߳� �d��FH�~��=��VA�u�+xq;0biI̛ZL�A6c����6�2�,VͿ`FK��Ҥ���$�E�����1�:J	;�j�
نm #��>��$�e��f�_�?���GX�0��~��1�FJ��~˨������RT��s���`��Z���w���x����2<���z��c�q����m��2%����0�*J�%꯬}����"���K��ݿ�۞c-�j�-�b���)K��L��v��v�XZ �+�;�dp������a�rn��ǆ�g�%/b��i1���w�JԾ�����1:��E��?����m���b˽E�5�U��=;[� ����m�
%A׹�-����w��.���v�Y��r(+aG����#��4��0���Ew�'n�D`�	R������ȟ�a��&�5w%��G��,l>�9n4Q/y�8�k��qt������"~�1)y����Ѯ`QJA�6dx�� 0���Z��;^�<��iBi���훌 R��dno<�_��o��5`?h?LR��r6�IL�t�tlq�C�(�R:�O���|�*��NB�	��@�MY$�4{䌌���W�*�Oߕ0�y>�Ϥa�O1��ϰş���A�yt�/	NU���0��?��9�%Ls�����q;�aG�K�<������9g�/<�ƹ\YK��������`��FPYK�����U03ky��YJ�R1yP�XM,�n�ߘ�`��HEG���J��1:F3$ S=%O����9�����+��S�U�f���Vk;5P�R�"�� �����X�*���~$���1�2��,߸D^-%�c��S,;n�TKg�bv}��f��[F�c���S2�>ku�j���yLo� I`�b�K�eizou�K̪�(2\ #���%~�m2V-��y(]�Z9����*'�oyF�a?.�V�[�dE�����rY�W��&��O1��_t�&PN�T}Oy�7x��M�<��|�5�4�zݼ��NX�n$�-JƊ�V�L���C;=O����z�n�7&��o�r��.y1C��t�'kU�g�r��͸���K�GH��3Õ?Q$��a	����?٤�2ɏ����Li�2�����W免(�����@VX��V��t��1�D��l�R�Q^�5F��������e�������T �YњW��8��!��^�b,O(m�m�ؤh����p��`NU��0nEK^Y�yhޘ��N�yX5F�nl3`=e:��\J��F:�Q���vZ�*���4�nӿ��ت��jo�^�I�����������44ٚ��Zi��$�*bao����h�P�����1v'��� �+��h���ҧ^#^E�}�
;*�6�X�΢e��o��Q�e>�ꓭ�We1	Sh��9DF��%�0�h&=�P��������*:O�wpL�JR�bչ4��[�v�xPǬ�I*�$�[h�/=7��j��?ꇥՑ����p�/ǚ[����t�� �P�*�[��;VP���9[T-ud#x�	���~͊���#z7�Oj��T���K:�������Tv+�L��������V�g�,��E_��eE��I�	NkR%����Hs���ү��(�y�+��{��U4Ȝ ���mP��QNו��^�.+bo#U4�l��vC�g�ݯzv�w�9]��oZ�g��n���S8_8�ִ��� ��^�&�~egxWlY��}����9l��:O�4����+oa,�d�k�� @gZbpj��V��ӻ������$��ō�Z�$=�[ua�bmB"W��uiY�
�{%���M8|ֱ�:6�#����<l�M��>��_�B�cE�]j4[���K���j��=�Y�H�T�>�φ����W^D^�s���[Æc�-6Z5���Q��a�OQt�6<��vc���.��b�\`�	5�p�a��1��5l7��6���s�GsVÀ�~,�2�`U�&�Sg��1k��hB�It��<x�;y�mW��\Z��_���iP:���:����~���l��H��ny����T�� ���܉�P���MD�a^���	R�+JgG/kԱ9Я������n���5��[�����{�jBGfSΌh��i԰�vs9���|ְ�(�Q�B"�E�~������#��u!��Km\nR<T�6u�r��ġg�ҥ8?v?;�lw�55\Cޙ�0��t6��+$�}p}��e�P�}������Qo^ ��0&�Øo �K������t�;�>��Β6#SWQ����n*�����O� U�R�p���m�ku%�ն�����l>�M�א�,�:t�*�(����rͻ�ٴM�z$�%g�A�|��<ω-{�n����b���T��/��"3����kw����ϒ��|b�leu6j���j�:�#KX�Ә���\�ay*�wN�� �6 ��$v��R��>��D`�.����/Xu]P�a�.W�y�LkvE�߹�݂U��m���k��PӮxG�W�a�&8	�Uܫ~/9l<�f�V^	P��@ 3`Ż���G�Ƈe~#�_���!&,�;x��]�eu��`�1Vؖ�\?@�PlMl�o�e��/
-��|n�����ҵ� +_p�[����S�>z.�ٿ5��96�m�p��� �Ό�Y;0��o�9GW���gG��Ii��"�y��)*.�����lf&���ϲ�����V)�ފ�%/�x*��=�&'K��z0tr���p���!V�T��
�R�~sS2z���
���V� 	�ە��s,T�    �8��1u��J�T<�q�x>���ט��o�:��=/<Z�:�
4��#�-Mv�ty!�\�q�@� �ƚs��g�u=��@����D�h�C�3���_	z�jU,��y 9��p�;�mZd��Kcj� �$}i�tk%�����)f�M.��A��Ks�t_'��r��5�4��شy�XB�c��Ǒ�!f�H��ʥ� �q	h���6�����O-��J���9ċw��O�[�)�/�9�٤@�L�� ��
0H)�����y��3�# �t=`�r;�����\�11��E�F[���pZo��� C=af$�����K.�� �\��՗ ��"���H��#�-��u.��P�<��#�Yָt����M���N1��=k�j�!���0:�Z=�D!�mu�%=�0������~"n�U����1@� �ۘP��! r�F02����z�^Kg�d"��Fb ���Me����}H+2C � ?
Q��AK�GTP�J�_b�!7y�O+������c�(�R�<�(@(�]<��b;�H�DCNq����.3a�� j�#�Z��, o��L��nLa�;�^.��@�G��Fx����
b�e�Kn��޼��'R%���n'��p�4s�<<�ӝ�y�[�,���~q��fD���6� ��9�?0-�+��W��>�R-���Tc�-����>I�HHQ�� ,<e�fW$�X��ǟ��v Xj}�ȸ�e?@�y�ht������0�W�d%Z~Ԁ������C���p���7˿)�IAR�M
f�To�"@3�M�D���<�J�*m�qW�������_<c@p�1����g�q`=+���;jM�h}r��yRsΝE|�D�����p�"�}L	:u"8e����� ��Ȗ�B�
��ֱ��i(.�k��h�E����.5���HW��3f�M��'�1�
�.�v�z�����B��48�.�\�6��e��B��-mOh�`k���E�d�������2����XB��y�t)lH��s�Ғ49+�t(�,R�Ca�i��sC99�}H`ŉ��F"��%��Z�8W�/�K)�׎nws���X:GLܲ��h7{�rID_'��e����Կ�l�zT�G2�Tqt5N`5:rԑ�F)��QG%q��#�[3䚫_&���;�M�ؗ�qTiOd�|�p������$Ӥ�!��|��J�[�օEC	��~�k�mP�"쪣f8.��93n�)�����+MN cw��I�GX:�uh_xZq�����N>%L[�7�6��	D$�D���<�1ĸ���R��w<�@ܔ��������e�GR����Ȟ_aV���$A����'y�b��p��+Hr��m�����\E�J�-��h�ۏ�,gqxV�v���N�IĖ��I�����T�m�U3��(:�!))����t�}wG5ܚ0c; ��R↤�d;2��[�cq�x�7�0����4�Lje�)���1�\I�F'C{+�1q�:�䷊,fv\x8�b�G�:����clD��b�A�J�"�(�E�8���ȗV����r���D�r���<i%���!M"��hP+�<*����Q��i�Jm&�R��	;ܻqޑ?�_Pu2y��)�:�>���TjQ%-��-�|���'\د�i�8B^���ll&Yu�6��,���ZN��S���q0��Ϩ���={�n$$#�iHJ^ǔڵ&|��l�e�5�ϡ4v��Ǒ�m&�j��_�h�zT<y�잀iG#�EYڪ���o�{y�dh����G!U`�v��V|iڈ5�nk�Վ4m�v�I�V-�?��*����1�(�����NH9򴝗F:{���6ގcLby�%��r�w���V:�2�-*w1���ߡ��./:�z��"��#O[�6(0�"R*u�ι����V���&G���lp@�<G	WK�u�r8�)�VZ��3�Ndi��ݞG�t$j�⪅�Ĥ��%� G���=6_8g!���8�$kp	����zG��k�j4�����Q��_l�?Q�tnlǫ�l�'>�����ST��<Ñĭ���}�ST�
�i�yp#*-�؎�m�r�<��Hܦ�M����s4�n���K~?�S��A%r���e	����?�2ؑ���O���=�gPcPy���W _�����r�X����w�{
�	�YI��WtŇ����O��v;�o��+��H�5��L ��U<���^<*��kU�����y�p?�j��{�G�Q��U���A�Mt�0��u_ "�<a۫��
�3�bu�����,��ؒ�V\���71a�����r}��NO� p%~1�qv$Y�B:臄�70;j��/��$X�F�8�H�@�)��	��f���u��"�kȣ̊��1a�D��]��"�)L��9��Mp�p�W��Ğ
^s����bJ�������j�:>�Հޣw�f��eL�|�	W\)�f�tjT��5�|E�Ij�ڥm�+]�O!Cl(���U<!4��T1�-`q�������?����_��䰽�S
���b�����0���<+o�H}�z@=�Pً6p�rB��Hj��)�`�5�	,	�Fb{#��u?E�!����R`-)��I��)0̒�[g)f���wW�07Ӄ�}��:z����y(/��DHA�����$�b���뵱�͂��_��>и�t�������o��a����5�9�]``*K��:��|���s���z��Y�c�31�k�}�*
&?���Vrȝ��Ov%^��:*)y��<��o��m�dT뇑a��g��q��r��vE�������4�c,�O���vϪ��@I��G����Bw���2)I�gG�wD>:��ؿ�s&X	$�oo8r���d�c�tp��d0��637�>^�d\0���'��AW��g��O�9~�������Ι#�\-�պ�{3�A��suH��o�zȴq�L"���{'��#�փR�Z׳F2Y<�1��8�qDb^p\XB�f�2��[�|3=�3�d|��pi�X2I��Ԙ-��ȅ��(f�O���	.��m�;�b��G��f=XԚ��`g�d��"N�)�U!GJ:|��_m��M
�1#m�Y4/�k���A\���T�c��g��
~&�r�l�M���OF=O�B�&�\�ݷ�e�}/ं�ؿ���sn~�D�d�̵��t�#���̐�R�-�Iw�]��*�0�qd�Wů�Ɯ��|M��Z���Bf'��T��s@�ʯv+�+I�G�W<�B�+A���l��M�_��r��=Շ;r9$��A�o(�SV	�eG��@����q�N��xy����� ��^�ّ��1�����A,x<���_�/����� o'�ꉝ�Tr�'>�fU��	#�4�ΘPx9�1o=�| pJ[M6�`+jM$��/��!:�ȅ�Nٽ5��g��7�	qxL�_�\c8*��y�V]pNB�Cث�$���/�AθP����m�!��@�)TO:GI���K+j6�8�x|�֐X�_6��}0�P��O0l��Q���:�M5�Z��J�
�2�� b���d���o�1Ø��n�!ā����&G�� /Tl�_.mwcn���n��.�S_(-��n��"�Gl�ooD�p���0,��KV�X
�z�5V�d�_Fn[ky����'��Us�_jC^�)&b(~���7w!H4Gh<[��3ǥ����$-��C��N�HI�^��n<@we�j�;��� �{�Ch�;ID�!,:k$���FS��/�`4�Q
d�zjжϥ����;���h��Y�`�E-�t��r�d�Kq������<�3�d�I��Vx�1<�p4�gs=f�� �s�:��d�_ZT�J5i��c�5Bv��.�T�ꋌ�Kݴk֝��X
�a2)��M�84��b
��d��4��CH�;��ש���-�4�9C��5��e��􇥢$�B�M�,9��$��g�*�.�2$Đ�h�9.�a� /�b�`C I���������>f�O5A��	LS2��DH��\�j�G�Ȇ    �c��\��ԱŃv.׋5t�v����ڐ�n���	F�E%�8���A#��4iA����4��՟Ԋ��
I�g���r�p�7PH���`z7�$|SF�%P5�tR[H���'��,J�G>�c�_Zr$j��r��)��LF�L��O��>7���.���N:R�In�*S�">�׿��wR6c�guTھL�H���d8���J�s�u��4�o_��#%sS'N�cG�>nF�o�MKf���m��+9��#���>7?c2�pUʍ.082�Y:�B?~~��R�c7nyzÁI�ǳ�/�6;��(�\Ց�o���L������حՕҢ�����^�7o\\#���)���T���x=K"�:��ktL���(L���l�"z�ث���I���J�?e����1��P���qF�?I���^�����:~H��g��T֧§��������vw��n�Za�{ܸ4v�$7��3t�������$tΟh�HA�eۤKՎ���R�HV���:�SH#�eI\�l��V�-�7�,����P$
T��y���D@��z����mG�@~���_��+]uS�"�#O�(9=���z�J����d���?��B=�����
B�@��xX��ya�˓T��БGP���R3mƪ���W�bI�'q��?I^A�qi�^>"� ��4����si�-ƫ#8=�FVAb�
�Z<�	�(g��[PX�'�a?���zG������Z��3�y7T�t�<���n�oo���*722���-��e߽5�h'H?x�[���P����}�ȴ�wD�Ax&�'s$HCh�N�;2Z|z#��ᄎ��t��Dh1�\&����3I�SnT���0適�bqi�H����j�wW�SR��H�Վ̄�:>��
=j�_�`g�T�z�nt,IX�
=i�d�S���Ka��I
y�d|�"2=E��A�6:��I�ܓ���m+�4N ��:��PɴG��[&C��Ub�ͫ#=�~�{%,_:!�C7�yr�)4�7jh�WB�"M��H�Q�z\_m��քs���I
�^��Wd�Y
	�UCǈϫ:�**������ƀ���-�S�&JW�e =�^�֤J��P[au3�������N�t�:3JdVxN`+��42�x�����z���idwL�u2"%f*�b��&�XWI![�N�����+�m/�(L���o�Aw�d�
9���q�|��'�2��/���T�B� ��<�q��V�v\!�!��n��%���V�GS�Q�����V!G!��_M�t���=,.Mzh$-$�{�vWՑ�Pq{N��}GC�G����^a�
�������݃y*�&���Pi�i{lߴ�ENC��ש#&�2$t��6Z��L��vsa�um�y؜Fɑ�p�����n����S�$?�b�a>z�d@�l#�8
�UY�j,�HB��"�(AZ-ڑ���_��
D�I��9R�>�4H�t'�X���q��dhl�t+�Ϛ#]����	{��uGD�ƃƈñ�h.�����8Qv�2�Sʘ��LB���z��3�f�s$�"!�m�JyU����ߪ\F�8f�7ɦ���Ϧ��%��p?~O,6iK.E"�W7�Aɗ��8����P���w0+�x�)�M>EemJЙ�i�Y9�e�D^�x�ۑNQ�㶥|yR*�$K]�zx�#�blD��D�3�{�9T�[�
?l]���3�ӗg���q>2fH�����!9Ob�eL�b��:Ȼ8��@r'G�EK���20��U٘Z�^�-і�D�;��ʕ��#���D�Fj�J���¦=6�[�Z�4szK�����}�R�@r�J=�;��I�q�<������.��U��]�'v����E�zb�[ʼ���:~K�۶-��nq�+K��;��e�k�|�4^�(��.�|��V��[�N�C��v��#\�Ww��Ggi�ܴл��E)W��\��~m	�2��Q�I�y���y����杶�9bu�r���(]�����~m�0����r6с`�9F��i���8�ޥ�A�]���CH�x��,�Ďs�z��FvGl~lW�
����N�����q�Lo�f����@.`ri?��D)��%���R[������$�܏:5���|����Y$��r?�GM��S�6�9"uGb3���r���x�]�����q-��;2��2��R.	ݷu�䑤�οV���@��%2W��
���=�N�#��NcF�@��&���g���L�vP�߹��=o����'L��H�H�ӰK�-�9*�0=�H�h��i���l+�#�iKG[ټ�i�m=�lZ�')S!�e�ّ�є5o�����&)7��3$u4Yx"s���ރ9�t�IK�dxtYZkKQL�J|��$H���ٹJ?:]�#�#�롋�O��R���Hz���eG��	�!d��V���H�)=,5�4�lؗ�@�*�u�݋�� $�{��4'$A���CH�|E��o�:�@
�O�H9��&�d�$6����ٚ �D�9�A�l:�q3А�R���ؤ����*q���+�d����c��`i��Q	rBN�c'')���+���L:+�B`Z�k7�Z 9"`OđW���>?9"]����
�d��9e_gs䇜b_�c�N�5��W
��T���&�Y#J�d�R��$.]��g�G��}��X2FN �+��8n�n�|�b������h3k_�!�>���ޚl�����'M�v��s��{N+I�����Y,�Yy~��4�s�������$�4lc��1�0F4�#I8���i�H:I�<���m��Q��
{X'��$��5�ьu�;t ���ueF����ʵ,;����,nz�בd�`8��D�ɓ욝E�Oo��Eq��#�0{�v�(:��սi�H4�	gY&�v����D�I�Z���\�Wdz��CrMHo�9�LHD:�s��I89�����V|�?��N���F�7�~���`�p"~.� ��z��_�6�B������'��,�l<e��0D+�7��g�O`�m���� Wϸ��P~ĸ���)j]%Gb:����J�������Naε��TK����b;����L�4����<d<�P���8���<���p���`�p��m���yi��N��T������Q\)$y%��>�,b�O6����cy_�$�$��U'�ri�>��<�ĉӑђ�� �|���/5��Ǒ�R?ծQ$lq$�����k�Z�e�/�:R[JR=�G��l8����4K�O0�T�U�G^ �5?�$�yj�,OSlt�IvI`l4���v9-�ݐ�Ri��|i/-�g�Gl�!�T��
���ҊQ$�N.��`��\�#�%o1��(h~�.ga��G4�녃�5����]�ğL��~lq��$=�`z%���F'���D#3�X6tKr+>�g;r^e��U�F �ǫ�V�E�c��`G�˓�Ҁ>I���j1� �H}ii�n��|r`
��Nz3�0gD������%���eP�$�ˍQf�S��N�'|H�j����)1�'���y�6+�b��\FOE�	���)�0r܎����$&üPt��e���sSh>M%�ӳ v>�$�����t>�T�DSO��Xzu��Qn������22cId�k ;&��e���@�隤_ߵ���`&0�1τ4���1�$ E���qt�dJ'����ñ�_c�.�Y��%e&��޶zXH���kNAtL���XdМ�q��4�D�i�d1��	�W%MK�(|��9��	�4��}��G�ɤI�z\l<tN�b�,�@MK���3O��a�'l�苈�ݖ����d�t����:�E�9��!��Ƶ\�i:���}�q���`���%���wi�nc�
fGM��#��`]1�w����n�Js�Q:�F&M���C��\m��)�E�N"Ǣ��͞��8m ����p�`)0�h]A�,��;�1i�OD���Nm�n����^D�w����K�A�ش9�G�C\�c+>/J9 �v?D�%�c~`��L
���K�U�[l�
��6Q���x� {�������_� GCR��9��dS�\��f�=��)
���    S�
KS���S�%��Ovr/,�)Q��3�x�bϝذ��smWc�i�=��S�#��Iy��G�N����ÎST:zܹ��I��3�m�ʮH5��S��*;Uޕ��lW���45�>�P���r�'��^�^4��y{S�[kg��=��H�T��Ђ��jw��Ś����.�	��~$�*�a�w<�hׁ�ܒ{�]l�A�I�T���؁Qۡ��ˠ���z<�Q�޲pAnK8�CK���39+�T�.�O�fZ�'�OiFW.�O�����dQ��F��96e��-֤��kǔ�1�B�i�L��k�I��:�|*s�OT'?!7���L�|�%���4зXj;���I!�D����.��J�p��d����. 9C0�rl$��~+8uZz3�����r��G+��L���_�!�E ���Gz�	��99�E���	M�DҋVrS�)�]D��*�i�b��r��=�m�[T2�B�x���S�x3���Qg����(�Ig�T�O�D��p�`�5/{)NϦH��v����M�·0�6_ͦ7h*yG�8%"!p�6�4���������N�fL�c�.��"�U�|��)�p�b3�ߐ��.��|��ې`<mq��G���.Z�9����"=)��)oq����~m�E�e3���\#;�Y���G��Ĥ�̶�9���)�V��v��IQW�HF��*�������1Kv����Z.��)o^��&�j�7Sd���N���SÀNW.IP:Ku�����]<�N~R��o|�Zѽ)��S,���^��'?)a��Tٓ������}T� ��(�%���=�I%F��αғ�� W'�mԓ�t._U j
�����'%wP�>[��$)%�^U�PO�R�1ٸm�IOJ�{���%oON�y�|�Pzӽ�6ie�b��2'z4"<W�7�r
.� ?�?��Q�[���M�q�|cE��(�Z�ա��$�Ѯ�w�~9�k7g=�HMx�ӻ�Oyr��l�'^��@(4�o9��R�G젍��yr��$��J���J����a�l��yR��a��Z�E/��}�3�B��q4�#S���R�s��F�	�G�|�5,\�,�4���'5)��?�����`nʉ�s��9{.a;��
K�V<�I	��2�R3�L�o�����[��]��Q��4K�>
��X��I<YJ]1mT|'��L��?�0�	�Clz�XlrQҬ�=��x~)e�=�}^��K�(�PĂ/��~�p������T�Ly�.���ܕj���Qs��Q��Y�������0M?A=`�Y ����~_��\?� W����v�j�����	�'pc�����WF-M�8^�ɫ_�n��Oz�/�~R�0l4�Y�=��#�,�Y�\��6�(��9t	�`F�������&���{) �D?6�@��oR��k�G�m�rNl
����R��N�����L�AU��`�>��J,���+~YQ�m�մI��>]�:w=}'~׳X�:X藕i2�j��2	���\�0�`��:�2^ ��w��#��L`�^T]rD*��#��D��n#O$���Ɂ�K�#'��(���|��9�n;��B¼�nզ膐q5uē������'=���8���r�r�#X��m׮(���Nt<ʸ���Z�q��}W���Y�m1��:�8x<š�����fx%ܥ�ޓȼk=�!��l<�hH]�y������6���ܫ9�N$z�&%�W� H�`�ڜ��� =��Mq�e��E��u�g�����8�"/(��������v�2�.��B�j��G���͋v���N�L�x]�����v�������?��q��mg$��~<0��t;��z-�}q��J0h��7��aH�<ء�YH��O���(u�&��^{��cح��)�6�����G�͛n6�����oVx�"6>����L��J����Q�힫d�;��F�6��³�Y��-^��t�51< @<��Y�n��fr�c�����_��x�t߹iv"���e�ba��(G��~PK�M�ؕ�$LOްM4������\ߝ�q)�s�̊�g����sSs��w�o�<]SG�Y���,�㞉��(��K
�� �|;Ңxz���I�Xt.������Ϧ��K��]T�ǭ��#�4����p�?�[�!�<?��g =��I8_��l���S@��b���_��)MÑF�y&h��N�(1��\I���L��AvO���Si��@.�xL�։�����$9%�4����vz�O�.ݎ��>��UGt9�߿��z�0t7����7��-mď�i�M	�B iiM�5�m�o����ڴ��M��v���)�_�Y�4�EE<��INS���I�Ii�!�}�,[H��W[R�Y�{::��%����7�E� ���fܛ��z�'�\5i
�
�r�V����=0~�1�E�w�@�� �{��9��4Swa�������2B�ظ׵��5��rO��hm�d��7�ԡ�o-y/�d����{y&ӬA7���g2>�l���7A�=�Ƌ~]
�C��g刋R��rI�ݷ	�͓���Δ�U�w�G�L�����'��+�T�n�c}��}�]~���ޙ��+gj��z��L�8�ɥn��\k�ޅX��:�{o��+���0�-$xyF���qr�{��Cir�K��<L��E���m
��b�c��#r�!���7�,��@���2qy�d���Y����*9����ޔ�+��Ŧ�S{//S��da1߇cX��X��#��^]�P[�K�H�۱�I@ ;�&#B�2e�|��H�}/R$��r���}n���s@�T�oc��GY����ЮZ~ح�Be�_��g����\������t�œ�tO�|<YN���x���9ģ9�Ħ�=�����j:e2F*�S[�5}�j<H��aJ�7�B�J��P��FM/����7�T�ٷ����^:Q����b�Y�$�Y�I	z���_ґ�c�fG�`��i�Gi�c��$�J�Q�i~sa�m`��   Q�FG�ĢJMy?&BA�M|�<�Jy�&�I&:�8���.��,���3��-<YEM^�{dƓX����;� �}`6��Fz�zۿ�(U��PE�D~���\)� ����	��{���|W�P\�!�(��Z�":|O�Qbq�#�[	㚷��FO�'�(�y���ج[�	&�o�C���� �L���=�z�3�|^(\����R����'�(�Xh�E��%J�|�HQW�K�<�J7�d�38�!'�ߴ�=�n�u�ГU�2����]T����yL��Ώ���[t�0��≜�iEo�m�ђYTg��E�}��@g���y2��A��,��h�=IF���'��i|���l�����$�G��/�AD�QKb�L_�t��N��&e��^���ĺ'�I8z.Xʑ���mݣM�y�2 �ћ$�!ğ���̈́�~�C�ʥ5��ZlJ�O2OzR��ҽ֮�')Q�O�¤"��bt_��JJR�jϱЫ��t�U�	����'+Kf�Y�d]�M:���������$�iTU�6M6�S:Ack�����O2��DH��IVJ4]���N�Rb'���E��6~�u-��1���ݝ�d,���床3���@1tٕOS'�~2�	|�G5<�L?���q|��Ln���/>����U��7Ikwiy5��1�.k�b�'�)煷��$��1��x!уS���������q����YM��)隂'�)�+�Y��p���~��gR�;L����M-����b7eT����d�]_�.���� ��m��#�6��@8>֡���1�O|�봞;���i`Ex*^�-/�X�Z��vŵ���i��d���{Q;�����{J\3_heZ}n_�Y]�xQ�^�ގ��~i��>e��5��31X�Ī���\���?�ߋ/\����cE^��`(�V�;)��`m*���b:����X]�%=J�� ^OC� */~S���ؘF%0m�i��GQ��6�fq�J��JkQ�1w:W�:�7�[�N�]�q#fB�,�9�" �  ��'��>���i�PDb��4ꄮx����7�hm���ًq��p��Ym�!��R�v�X!"��\�3�RT��]	໩;K3�Ke�����V_���,n`/�-&U��C�Dc)"�:Ok>� $��"�E 
��Em�E����Q/
�z\"�NhQy���_�]��Z�K(������"��v�bF�����b�6��ŷ����Ak���f{����$�A��?�`Ғ� �6
\{����έb�����t��zz��EwimH����h�ɞ��"����h]�S�B���8 ��ڜ�x�E�z<a�>͕&у�Ej:���
P��l��yC��3iC7�.laކу֥��oҬJ��=�iIU��W��P��9"AH2ut������&B�z<Iq�!�������?d;�      '   b  x�u�MN�0FיS��v��e����R��Ik������>c@�A�i��y��2QI�Mp�NԦ�����g}%�ڛ��� mqD�_tԮm�#�3�t�C1�P&���a�J;t4��Ğ,�>�.X��'�������4���oP���w�A�I6a��ŀd�݈�h@fl�A��5��{��@�hނ�Ղ,8�ëx��ɒ��R:���g��SQr���w��[w��oĆ�(��K������T�@-�b-*P��n�	T�,Koܙ�
V�i��T��5��	D��<Ơ[��(@������5�C�m��`?_O6�I9���R�U�E�V�(�� � 8y�            x�3����� � �      0     x����nI��+O1O�T�K�U�
����)ʄ%���N��	;�V��Qk.�U.���wG�+���z�UWO��˝{w1=��^��x��$9��������˷�V�|̈pԊG�t��G�r��Y�l��2�m��p�j�J��k)��9��GH%�x�����C<y&��Y|t�}6�tbp�����\ct��/�׺�\��޴/�'ۏz��'��˝-왲K����r}`�X�����߮�_o�����4Dh9G:&�F��� �������C�d�S���)8[�Y��=��^��i�������N��-����0S��������K�~�u����-bM�u� � �O??�bρ%�g�ݯ��z�7��i�K������n��Q���y�l�Y�ރfs��f:[o>�^����ٿe�s,IZ�A�PA{ᓧ<{5~�'�����=a���3&�ZF/�̮���Dn4M@�9QTs���|�DHZES)3����8�����ܻ#���+ �T$�0o^�2�P��:j�G�*=�I�,����k�x�\c7����V�g�֥֥�B��hE��j�칓!�fG��Jn������_��O���K�F���08&"�
K3� ~�)�	f�vN���ܹ�5g�s3`R�Ж(v[�7c�v� �^[�цp��R2B驈�:�
{72��G������=�V���aݛ:��q,��q���[S�ު��+��ɲ8�/��G<��|�:WKխAT�ȽuMF"�J9f�	���E f������C���5
��z�P �l�-3B�K�!.�-�i��z����)C�+�5k(�[ M�93_���s��՟��,��BeC>��ưf�"��?�8Os��9xxX�T[��t�����ۇE�ŜD��iF*�}�pI!sW�pP'h>��$��̡J��K߄����Bz4���}�'�E�ƈ1{V3�Բi�!�Q�s��>z�(�7A��7I&̭t2�K��M�����0=��V�Y߬WO6�����Hb������-y�`���e���������/��6      +   �  x��Z[s��}^�
��z���'Q�0��R��K^�
â(AE�}��.@���6�"��`f�/���L���_jy��=\jbb���������[QN��߾^�?�`�в>��-���w��voW�q�=���_)u�r!��A�y���%�����/q��}������w\_.Z�@A��V7����^�t[���f�V�󖴏����:�lV��ޔϫ�݇x�wc�δfk==s*`uL7]����^M���$��Tj��~���6ck_������|���u��a�k$�%L�xﶛx�$���f����9���6L�n?nn�z;���o�?L�'3����������}�U�&U+�
��?�6�h\U�u�I+��aH✔�R��|r�(%�k]c
�*�Q�,�� �>:KVls&K�g�t6��c�ۛ����C��5f�a|l9�g�=J28�"��ܛ��_~���W�/'��ل1.&�"M�fC�ѩ�K�9d��8ik���O�)�R�S\�KJ�P�%$�^��ٹ1��dc󖴩���M�\�&��D_,����M�1b�%GvA���b��L�jw��ԛ�����/�Z>O�;�w�"�D����J�Cj��a�g�KK�a���b����y���1��I�����[�%��M��]��]��w��W��� ~���̻�(�/�]l�-����)���̈́�y�uS6�lJ�?qa{����}���:A��4���VS|�d���o��ہ�K�����d�s�1�<�
�U`�6&X�9��ۅ�Cߜ���;}-���n�Ņ��fx�͗�ꇏ�xs�+���}��2����꣄��үc���nU
2����2���zRF�����W�?��x:�d
.�Υ��M��kT����kEۑ��=#�I�E��k���y���rpE��%bQ�{jɇ��<���6�!�c�u�->4��>����x��'#ş	9W_\'��$�ޞ���7e���t쫜B�恔�J���|'OZ[J�pm��S�[�()1�A��jZ!D�^e&�L�*M[
a�0\Kk�(xHc��+��i:k�_+��O��餆���Ȩg�O�gb{�`�@72��8)x�A�M�����\�����C2莁?��@xI��qƌ��:��j5J�X�{���.��;�1��UeTxS��������:dYe�$l�T,��2ͅ��=�9�Iu^��E%�E�ZG$�d�� �(OH	�9�)��/T�Be�=�Փ���O3�oE���"N�X!3�}0'H��|*�لJ�m�N�� ��D�*�&��8UrK	>H9�Xk@�<��M6c�Q��I����6��,���H��y����۱�R 2�X`�(�����ʟ1��A�F�g�H��-9(,~oÇ����`��T'SUL���f�I614Dy���!�|�(�RJȖF�QhH�c���? ��9
�f �,�fۈk��*����H5�Bu�d1�ͧ���r�ٿ�9K�.�f��@��¦Y�������6j[/o'=����HD��^�_����d6 
�v�n���kl��c��4gm�M+<XP)pԌ@	֗�Gm�<���[�,Q�;E�i�`1 ����u��P�Y��bgK7�j�9��X�-줘y�y�/�4���VA�:G��B���_�ml�GLa���7�/�_fH=��e�>��;ipK���`�
Al�e�N���8� S�t>9��j��mv���՞�nV�F�_���Ձ���09H�0H���V���(�9���� ���4Q@W[K�ma(,���c��o9��q���![��%FQ@=�PB� �]��1���C����,o6D��?�$T5Y0{P�G���$��ˎ1'�ݾ��w����A�G�Z��~�z��r�V��Ƌ��s&n����}��ަ ���N)8n���>�FE)��LD�؅3���x���5g]El$O�e���sV����6S�X�s@���U)��i�'����	�Pt?mo���3Py��8�Op����:���]�5j������ǌ)�n���j�:�̰Mҕ�� ?q)%�!�z,7h�`��J�N^�:u����.@)pIW�H)�{P��{���x�E��Qw�� Ȟ�s��@}��'��m�\�k���[?�����x��C�9�t�����~�!n⦔��g}��Sl� nP5`�-�0k��*�P"A3��V��G3�*�u�j�%5�q3d��⅝C�@G�¤�r�c��`�թY[��!^I�0ϴԐp���}O'��>n@Px��G�)��+�W�@�T���=w���9�A)�-TO�AMFd������l�^�	�=�P��Pƛ���b`�9�袡{�
bH�7�9ܦZK�3��G��}S��!�)��v��r�@{�I��˻xS�V��m���,��Ï�~��`��5h�V�{3���,f�/K:�8F)!��RH�)��M��M\XG�N�N��'�T�Z	��cP�J��:\kés� �@A��!g8���5; �$ZU��@���3iF��s�~N�B_�uF�=��$k ��yR�f�?�^x���7W���7^כ!�^�F��@��^
�( �G,st��� [������e��^�kK������T���i�V&x��t��*�]W����}o�"����:���b��;�0:SP��y��kM�#&o^�&D� ����5��b�O�? ���l���w:7:��xE�	9�(0�a���E��>b�Y�aq�k�I�P1 ����)�҅Ag���w����Տq��nꉷ{ߖ�1^�L��A\g����{�"yt����X�a��ю{$z�wD��?Ρ��;��	(�f�3�w��^�.,`QR<d��L�Qo�WԙXT�&,,�C!��;�4RЕa����42���M!r�yPn�J5B0�(�#Hu(��I���R�nF�wf �G"���2�^��sN����kD�(��[��ȇ��=6����	�M���w 'u�o�,�A�����)&< l��4�FK46З��a AP����0��g��ٹ,�����Z#U�R��@����_*cM��J��(�ʒ 1OS�<�)�ݟ8i{���J١F�@6���.o�A'��e>�#0E��Y�ro9�� �=���Aj�6�i�2�ʮ���C%��s52_a5K.�K��V]�w]�C4#�C�`�P��j���.�LG���
��P��a��k�U�A߫o�;v�!���A�;΋�FE����ь�ㆊ]*ƭ�����w�?���¢��Kst(�q�T�fʵ7����$�:N�f�Wpĭ����B�|A�W���G��y���	�4�����6�-tD9�M�eu�����&���+t"�e�|0���U��BY{ �3���hA�������ջ�^�;>������Z-�K}c.X�a*���٧����"~����LA�����{�9:�� }�V��m2ڐC�\5�@���9�b����T�=�^H���T�4W�R��ݯ��!��a(�ޙ�S�����Lm>�;���'6O#�~�X��4fݛ@��o���P� �!q�(N��!,%O@��J��D�x��P�Ϲ9�~�#0ƙ�Ԓs58hF�T��Zl��h�)10��$��|�q�3���	�ki9*Ͻ���b�ٮ.o~���'���jI��֓j���1�� ��m�x�웧�!�m�kӖ��u���ŋ��lX�      G     x��Tێ�6}����C�Y���5�����E��1@1Gm�4Ԫ���d�k�i���rΙ+�վ?T�1����������o>�u��	�y��S��ٓ�i���u��X?nZ���v�X�h�*�mĀ�qc���� �e;6��Р{��Uj0���Kl��y�V�'~u'�'YYdaU������Q^��~��7~ �p�ǻ �,
�x��3���Q�cw���շ9���x�h�2ƚ��q��u�iK��J&E
YuG��OV�Q�z�̢H �?�ҧ#I}:jy�n�(�eP�i*����P"�)�(��O�:���.
�(�$[��h��;0�W ��G�x"5��J/ȝ5>n*���CS��?��������w⩧�{)
��?�^��������g!Ǯ;�;ak�Z��������#�[��ȑ�=q�[�,{�h�/&�9�c�}|f�I�
� �}zS�ތ{4'c's���ړ р�x^�1�Ut�F)�c3���.��c�:�X��'�܂���Y=���L�0񚷢B��A!�(G'@�]�i���ph�J5���{-��:Pf��8�b�g�P�`�K���5�f���"�ILʵ˖��p&���K'�Et�w�q�,���@�z��2SaKX�tr��XjE��O�v��V��;�u8��,���*=�َ+D�Z����Ǹ���;��9���S�k�pe�q��I����~���\H��/��̥yՁ,�0+�2e� qPE|��~���-�wA��q�f����^�?gI��      %   [   x�3�4�6T�UI����V��K�/�M,��4202�50�54U04�20�26�307�0��#�e3/8��$5�y&z�&&��x��b���� e$Q      &   F   x�3�tLN��2�.�M,I-JT-I,J�2A8�%\��A���\f�^��I�\���ԜĒ�<�=... ޯ      B      x�u�]k�A��'�"� ��|��eJK�� �
Bof�j��b
��ݦb"(�,���3��#����|��AG����5b�b�dꡐ(�>?�CD��׷���	��~���[��e�A�-Xo20G�L�Mb�x0P��v���=���]\߾]��?��/P �l����}7���p¤*���D�n�Ke���n��wcMҫ���E��gLM4E)��JB�O���q�Cj�Pjn��BƵT��}U���O�g y!�TZ���1��2��[�B��!�#;j0�&NC8������,�Lݚ�Ê�`��h��Yg<�=1�ڛ�j.͒!en�,3�sm��_��?-/��R��0F$�>D�z��꣕��K w�I����:_�\-�\ܮ7���""p���m���S�R�c��]G��@3�s�b��7�ionJ�Z�I	=�a�Ƣs,�&��J�2�r,g��O������ ����^dn�5�%���%����m.���?�ݭ��/?��      <   :   x�3�v���q�P0��J�I�S����4�2��A�+*���pac�pbR2�W� ̎_         R   x�3�4202�F`���������������������)??G�O7.C�"�A����LM��LM0�@������� OBI      *      x������ � �     