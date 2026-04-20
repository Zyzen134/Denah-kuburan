import { db } from '@/db';
import { graves, blocks, deceased } from '@/db/schema';
import { NextResponse } from 'next/server';
import { eq } from 'drizzle-orm';

export async function GET(request: Request) {
  try {
    const { searchParams } = new URL(request.url);
    const blockId = searchParams.get('blockId');

    const baseQuery = db.select({
      id: graves.id,
      blockId: graves.blockId,
      plotNumber: graves.plotNumber,
      row: graves.row,
      column: graves.column,
      status: graves.status,
      blockName: blocks.name,
      deceasedName: deceased.fullName,
      deceasedId: deceased.id,
    })
    .from(graves)
    .leftJoin(blocks, eq(graves.blockId, blocks.id))
    .leftJoin(deceased, eq(graves.id, deceased.graveId));

    const allGraves = blockId 
      ? await baseQuery.where(eq(graves.blockId, parseInt(blockId)))
      : await baseQuery;

    return NextResponse.json(allGraves);
  } catch (error) {
    console.error('Error fetching graves:', error);
    return NextResponse.json({ error: 'Failed to fetch graves' }, { status: 500 });
  }
}

export async function POST(request: Request) {
  try {
    const body = await request.json();
    const { blockId, plotNumber, row, column, status } = body;

    const newGrave = await db.insert(graves).values({
      blockId,
      plotNumber,
      row,
      column,
      status: status || 'available',
    }).returning();

    return NextResponse.json(newGrave[0]);
  } catch (error) {
    console.error('Error creating grave:', error);
    return NextResponse.json({ error: 'Failed to create grave' }, { status: 500 });
  }
}
