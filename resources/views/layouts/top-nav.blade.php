<div class="layoutContainer" >
    <div class="container mb-4">
        <div class="row">
                @if(Auth::user()->Clave_Rol==1)
                    <div class="col text-center btn-hover">
                        <a @if(request()->path() == 'Admin/Compania')){ } @else { href="{{ url('/Admin/Compania') }}" } @endif class="btn btns-grid border-light btn-layout btn-grid @if(request()->path() == 'Admin/Compania')){ selected } @else {} @endif">
                            <div><i class="material-icons" style="vertical-align: bottom;">
                                    work
                                </i></div>
                            <div>Compañias</div>
                        </a>
                    </div>
                @endif
                @if(Auth::user()->Clave_Rol==1)
                    <div class="col text-center btn-hover">
                        <a @if(request()->path() == 'Admin/Roles')){ } @else { href="{{ url('/Admin/Roles') }}" } @endif class="btn btns-grid border-light btn-layout btn-grid @if(request()->path() == 'Admin/Roles')){ selected } @else {} @endif">
                            <div><i class="material-icons" style="vertical-align: bottom;">
                                    supervised_user_circle
                                </i></div>
                            <div>Roles</div>
                        </a>
                    </div>
                @endif
                @if(Auth::user()->Clave_Rol==1||Auth::user()->Clave_Rol==2)
                    <div class="col text-center btn-hover">
                        <a @if(request()->path() == 'Admin/Areas')){ } @else { href="{{ url('/Admin/Areas') }}" } @endif class="btn btns-grid border-light btn-layout btn-grid @if(request()->path() == 'Admin/Areas')){ selected } @else {} @endif">
                            <div><i class="material-icons" style="vertical-align: bottom;">
                                    insert_chart
                                </i></div>
                            <div>Áreas</div>
                        </a>
                    </div>
                @endif
                @if(Auth::user()->Clave_Rol==1||Auth::user()->Clave_Rol==2)
                    <div class="col text-center btn-hover">
                        <a @if(request()->path() == 'Admin/Puestos')){ } @else { href="{{ url('/Admin/Puestos') }}" } @endif class="btn btns-grid border-light btn-layout btn-grid @if(request()->path() == 'Admin/Puestos')){ selected } @else {} @endif">
                            <div><i class="material-icons" style="vertical-align: bottom;">
                                    verified_user
                                </i></div>
                            <div>Puestos</div>
                        </a>
                    </div>
                @endif
                @if(Auth::user()->Clave_Rol==1||Auth::user()->Clave_Rol==2)
                    <div class="col text-center btn-hover">
                        <a @if(request()->path() == 'Admin/Status')){ } @else { href="{{ url('/Admin/Status') }}" } @endif class="btn btns-grid border-light btn-layout btn-grid @if(request()->path() == 'Admin/Status')){ selected } @else {} @endif">
                            <div><i class="material-icons" style="vertical-align: bottom;">
                                    find_replace
                                </i></div>
                            <div>Estado</div>
                        </a>
                    </div>
                @endif
                @if(Auth::user()->Clave_Rol==1||Auth::user()->Clave_Rol==2)
                    <div class="col text-center btn-hover">
                        <a @if(request()->path() == 'Admin/Usuarios')){ } @else { href="{{ url('/Admin/Usuarios') }}" } @endif class="btn btns-grid border-light btn-layout btn-grid @if(request()->path() == 'Admin/Usuarios')){ selected } @else {} @endif">
                            <div><i class="material-icons" style="vertical-align: bottom;">
                                    group
                                </i></div>
                            <div>Usuarios</div>
                        </a>
                    </div>
                @endif
                @if(Auth::user()->Clave_Rol==4||Auth::user()->Clave_Rol==3)
                    <div class="col text-center btn-hover">
                        <a @if(request()->path() == 'Admin/Proyectos')){ } @else { href="{{ url('/Admin/Proyectos') }}" } @endif class="btn btns-grid border-light btn-layout btn-grid @if(request()->path() == 'Admin/Proyectos')){ selected } @else {} @endif">
                            <div><i class="material-icons" style="vertical-align: bottom;">
                                    schedule
                                </i></div>
                            <div>Proyectos</div>
                        </a>
                    </div>
                @endif
                @if(Auth::user()->Clave_Rol==4)
                    <div class="col text-center btn-hover">
                        <a @if(request()->path() == 'Admin/RolesProyectos')){ } @else { href="{{ url('/Admin/RolesProyectos') }}" } @endif class="btn btns-grid border-light btn-layout btn-grid @if(request()->path() == 'Admin/RolesProyectos')){ selected } @else {} @endif">
                            <div><i class="material-icons" style="vertical-align: bottom;">
                                    how_to_reg
                                </i></div>
                            <div>Roles en Proyectos</div>
                        </a>
                    </div>
                @endif
                    @if(Auth::user()->Clave_Rol==4)
                        <div class="col text-center btn-hover">
                            <a @if(request()->path() == 'Admin/Etapas')){ } @else { href="{{ url('/Admin/Etapas') }}" } @endif class="btn btns-grid border-light btn-layout btn-grid @if(request()->path() == 'Admin/Etapas')){ selected } @else {} @endif">
                                <div><i class="material-icons" style="vertical-align: bottom;">
                                        layers
                                    </i></div>
                                <div>Etapas</div>
                            </a>
                        </div>
                    @endif
                @if(Auth::user()->Clave_Rol==1||Auth::user()->Clave_Rol==2)
                    <div class="col text-center btn-hover">
                        <a @if(request()->path() == 'Admin/RolesRASIC')){ } @else { href="{{ url('/Admin/RolesRASIC') }}" } @endif class="btn btns-grid border-light btn-layout btn-grid @if(request()->path() == 'Admin/RolesRASIC')){ selected } @else {} @endif">
                            <div><i class="material-icons" style="vertical-align: bottom;">
                                    beenhere
                                </i></div>
                            <div>Roles RASIC</div>
                        </a>
                    </div>
                @endif
                @if(Auth::user()->Clave_Rol==1||Auth::user()->Clave_Rol==2)
                    <div class="col text-center btn-hover">
                        <a @if(request()->path() == 'Admin/Indicador')){ } @else { href="{{ url('/Admin/Indicador') }}" } @endif class="btn btns-grid border-light btn-layout btn-grid @if(request()->path() == 'Admin/Indicador')){ selected } @else {} @endif">
                            <div><i class="material-icons" style="vertical-align: bottom;">
                                    trending_up
                                </i></div>
                            <div>Indicadores</div>
                        </a>
                    </div>
                @endif
                @if(Auth::user()->Clave_Rol==1||Auth::user()->Clave_Rol==2)
                    <div class="col text-center btn-hover">
                        <a @if(request()->path() == 'Admin/Fases')){ } @else { href="{{ url('/Admin/Fases') }}" } @endif class="btn btns-grid border-light btn-layout btn-grid @if(request()->path() == 'Admin/Fases')){ selected } @else {} @endif">
                            <div><i class="material-icons" style="vertical-align: bottom;">
                                    public
                                </i></div>
                            <div>Fases</div>
                        </a>
                    </div>
                @endif
                @if(Auth::user()->Clave_Rol==1||Auth::user()->Clave_Rol==2)
                    <div class="col text-center btn-hover">
                        <a @if(request()->path() == 'Admin/Enfoques')){ } @else { href="{{ url('/Admin/Enfoques') }}" } @endif class="btn btns-grid border-light btn-layout btn-grid @if(request()->path() == 'Admin/Enfoques')){ selected } @else {} @endif">
                            <div><i class="material-icons" style="vertical-align: bottom;">
                                    policy
                                </i></div>
                            <div>Enfoques</div>
                        </a>
                    </div>
                @endif
                @if(Auth::user()->Clave_Rol==1||Auth::user()->Clave_Rol==2)
                    <div class="col text-center btn-hover">
                        <a @if(request()->path() == 'Admin/Trabajos')){ } @else { href="{{ url('/Admin/Trabajos') }}" } @endif class="btn btns-grid border-light btn-layout btn-grid @if(request()->path() == 'Admin/Trabajos')){ selected } @else {} @endif">
                            <div><i class="material-icons" style="vertical-align: bottom;">
                                    assignment
                                </i></div>
                            <div>Trabajos</div>
                        </a>
                    </div>
                @endif
                @if(Auth::user()->Clave_Rol==3||Auth::user()->Clave_Rol==4)
                    <div class="col text-center btn-hover">
                        <a @if(request()->path() == 'Admin/Actividades')){ } @else { href="{{ url('/Admin/Actividades') }}" } @endif class="btn btns-grid border-light btn-layout btn-grid @if(request()->path() == 'Admin/Actividades')){ selected } @else {} @endif">
                            <div><i class="material-icons" style="vertical-align: bottom;">
                                    list_alt
                                </i></div>
                            <div>Actividades</div>
                        </a>
                    </div>
                @endif
                    @if(Auth::user()->Clave_Rol==2||Auth::user()->Clave_Rol==4)
                        <div class="col text-center btn-hover">
                            <a @if(request()->path() == 'Admin/Actividades/Prepare')){ } @else { href="{{ url('/Admin/Actividades/Prepare') }}" } @endif class="btn btns-grid border-light btn-layout btn-grid @if(request()->path() == 'Admin/Actividades/Prepare')){ selected } @else {} @endif">
                                <div><i class="material-icons" style="vertical-align: bottom;">
                                        picture_as_pdf
                                    </i></div>
                                <div>Reporte de Actividades</div>
                            </a>
                        </div>
                    @endif
                    @if(Auth::user()->Clave_Rol==2||Auth::user()->Clave_Rol==4)
                        <div class="col text-center btn-hover">
                            <a @if(request()->path() == 'Admin/Etapas/Prepare')){ } @else { href="{{ url('/Admin/Etapas/Prepare') }}" } @endif class="btn btns-grid border-light btn-layout btn-grid @if(request()->path() == 'Admin/Etapas/Prepare')){ selected } @else {} @endif">
                                <div><i class="material-icons" style="vertical-align: bottom;">
                                        picture_as_pdf
                                    </i></div>
                                <div>Reporte de Etapas</div>
                            </a>
                        </div>
                    @endif
                    @if(Auth::user()->Clave_Rol==2||Auth::user()->Clave_Rol==4)
                        <div class="col text-center btn-hover">
                            <a @if(request()->path() == 'Admin/Proyectos/Prepare')){ } @else { href="{{ url('/Admin/Proyectos/Prepare') }}" } @endif class="btn btns-grid border-light btn-layout btn-grid @if(request()->path() == 'Admin/Proyectos/Prepare')){ selected } @else {} @endif">
                                <div><i class="material-icons" style="vertical-align: bottom;">
                                        picture_as_pdf
                                    </i></div>
                                <div>Reporte de Proyectos</div>
                            </a>
                        </div>
                    @endif
                    @if(Auth::user()->Clave_Rol==2||Auth::user()->Clave_Rol==4)
                        <div class="col text-center btn-hover">
                            <a @if(request()->path() == 'Admin/Usuarios/Prepare')){ } @else { href="{{ url('/Admin/Usuarios/Prepare') }}" } @endif class="btn btns-grid border-light btn-layout btn-grid @if(request()->path() == 'Admin/Usuarios/Prepare')){ selected } @else {} @endif">
                                <div><i class="material-icons" style="vertical-align: bottom;">
                                        picture_as_pdf
                                    </i></div>
                                <div>Reporte de Usuarios</div>
                            </a>
                        </div>
                    @endif
                    @if(Auth::user()->Clave_Rol==2||Auth::user()->Clave_Rol==4)
                        <div class="col text-center btn-hover">
                            <a @if(request()->path() == 'Admin/RolesProyectos/Prepare')){ } @else { href="{{ url('/Admin/RolesProyectos/Prepare') }}" } @endif class="btn btns-grid border-light btn-layout btn-grid @if(request()->path() == 'Admin/RolesProyectos/Prepare')){ selected } @else {} @endif">
                                <div><i class="material-icons" style="vertical-align: bottom;">
                                        picture_as_pdf
                                    </i></div>
                                <div>Reporte de Usuarios en Proyectos</div>
                            </a>
                        </div>
                    @endif
        </div>
    </div>
</div>
